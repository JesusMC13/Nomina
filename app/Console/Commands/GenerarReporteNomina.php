<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empleado;
use App\Models\ReporteNomina;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerarReporteNomina extends Command
{
    protected $signature = 'nomina:generar';
    protected $description = 'Genera el reporte de nómina automáticamente los viernes';

    public function handle()
    {
        if (Carbon::now()->isFriday()) {
            try {
                DB::transaction(function () {
                    $empleados = Empleado::with(['diasDescanso', 'puesto'])
                        ->whereHas('user', function($q) {
                            $q->where('active', true);
                        })
                        ->get();

                    $detalles = [];
                    $totalNomina = 0;
                    $fechaReporte = Carbon::now();

                    foreach ($empleados as $empleado) {
                        $diasTrabajados = $this->calcularDiasTrabajados($empleado, $fechaReporte);
                        $descuentos = $this->calcularDescuentos($empleado, $fechaReporte);
                        $pagoTotal = $this->calcularPagoTotal($empleado, $diasTrabajados, $descuentos);

                        $detalles[] = [
                            'empleado_id' => $empleado->ID_empleado,
                            'nombre' => $empleado->nombre_completo,
                            'puesto' => $empleado->puesto->nombre ?? 'Sin puesto',
                            'sueldo_diario' => $empleado->sueldo_diario,
                            'dias_trabajados' => $diasTrabajados,
                            'dia_descanso' => $empleado->diasDescanso->first()->nombre_dia ?? 'Domingo',
                            'descuentos' => $descuentos,
                            'pago_total' => $pagoTotal
                        ];

                        $totalNomina += $pagoTotal;
                    }

                    ReporteNomina::create([
                        'fecha_reporte' => $fechaReporte,
                        'total_empleados' => count($detalles),
                        'total_nomina' => $totalNomina,
                        'detalles' => $detalles,
                        'creado_por' => 1 // Usuario admin por defecto
                    ]);

                    Log::info("Reporte de nómina generado automáticamente para " . count($detalles) . " empleados.");
                });

                $this->info('Reporte de nómina generado exitosamente.');
            } catch (\Exception $e) {
                Log::error("Error al generar reporte de nómina automático: " . $e->getMessage());
                $this->error('Error al generar el reporte: ' . $e->getMessage());
            }
        } else {
            $this->info('Hoy no es viernes, no se generará el reporte automático.');
        }
    }

    // Métodos de cálculo (similares a los del controlador)
    private function calcularDiasTrabajados($empleado, $fechaReporte) { /* ... */ }
    private function calcularDescuentos($empleado, $fechaReporte) { /* ... */ }
    private function calcularPagoTotal($empleado, $diasTrabajados, $descuentos) { /* ... */ }
}
