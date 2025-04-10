<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empleado;
use App\Models\Nomina;
use App\Models\Asistencia;
use App\Models\Descuento;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerarNominas extends Command
{
    protected $signature = 'nominas:generar';
    protected $description = 'Genera nóminas semanales para todos los empleados';

    public function handle()
    {
        $this->info('Iniciando generación de nóminas...');
        $fechaInicio = Carbon::now()->startOfWeek();
        $fechaFin = Carbon::now()->endOfWeek();

        $empleados = Empleado::with(['puesto', 'asistencias' => function($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
        }])->get();

        foreach ($empleados as $empleado) {
            try {
                $this->line("Procesando empleado: {$empleado->nombre} {$empleado->apellido_paterno}");

                // 1. Calcular días trabajados (considerando asistencias con <= 15 mins de retraso)
                $diasTrabajados = $empleado->asistencias
                    ->filter(function($asistencia) {
                        return !$asistencia->minutos_retraso || $asistencia->minutos_retraso <= 15;
                    })->count();

                if ($diasTrabajados == 0) {
                    $this->line("El empleado {$empleado->nombre} no tiene días trabajados en este periodo");
                    continue;
                }

                // 2. Calcular sueldos (basado en $1,200 semanales / 6 días = $200 diarios)
                $sueldoDiario = $empleado->puesto->salario_base / 6;
                $sueldoBase = $sueldoDiario * $diasTrabajados;

                // 3. Calcular descuentos (suma de todos los descuentos en el periodo)
                $totalDescuentos = Descuento::where('ID_empleado', $empleado->ID_empleado)
                    ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                    ->sum('monto');

                // 4. Preparar datos para la nómina
                $nominaData = [
                    'ID_empleado' => $empleado->ID_empleado,
                    'fecha_inicio' => $fechaInicio,
                    'fecha_fin' => $fechaFin,
                    'dias_trabajados' => $diasTrabajados,
                    'sueldo_base' => $sueldoBase,
                    'horas_extras' => 0, // Puedes calcular esto si aplica
                    'bonificaciones' => 0, // Puedes calcular esto si aplica
                    'sueldo_bruto' => $sueldoBase,
                    'total_descuentos' => $totalDescuentos,
                    'sueldo_neto' => $sueldoBase - $totalDescuentos,
                    'estado' => 'pendiente',
                    'periodo' => 'semanal',
                    'fecha_pago' => $fechaFin->copy()->addWeekdays(3) // Pago 3 días después del fin de semana
                ];

                // 5. Verificar si ya existe una nómina para este periodo
                $existeNomina = Nomina::where('ID_empleado', $empleado->ID_empleado)
                    ->where('fecha_inicio', $fechaInicio)
                    ->exists();

                if (!$existeNomina) {
                    DB::beginTransaction();
                    try {
                        $nomina = Nomina::create($nominaData);

                        // Asociar descuentos específicos a esta nómina (opcional)
                        $descuentosIds = Descuento::where('ID_empleado', $empleado->ID_empleado)
                            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                            ->pluck('id');

                        $nomina->descuentos()->attach($descuentosIds);

                        DB::commit();

                        $this->info("✅ Nómina generada para {$empleado->nombre}:");
                        $this->line("   - Días trabajados: {$diasTrabajados}");
                        $this->line("   - Sueldo diario: $" . number_format($sueldoDiario, 2));
                        $this->line("   - Total bruto: $" . number_format($sueldoBase, 2));
                        $this->line("   - Descuentos: $" . number_format($totalDescuentos, 2));
                        $this->line("   - Neto a pagar: $" . number_format($nomina->sueldo_neto, 2));

                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                    }
                } else {
                    $this->line("⏭️  Nómina ya existe para {$empleado->nombre} en este periodo, omitiendo...");
                }

            } catch (\Exception $e) {
                $this->error("❌ Error procesando empleado {$empleado->nombre}: " . $e->getMessage());
                Log::error("Error generando nómina para {$empleado->nombre}", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        $this->info('✔️ Generación de nóminas completada!');
    }
}
