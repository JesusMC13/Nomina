<?php

namespace App\Console\Commands;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VerificarRetardos extends Command
{
    protected $signature = 'retardos:verificar';
    protected $description = 'Verifica el cálculo de retardos y descuentos';

    public function handle()
    {
        $asistencias = Asistencia::with(['empleado.turno', 'empleado.puesto'])
            ->whereNotNull('hora_inicio')
            ->get();

        $this->table(
            ['ID', 'Empleado', 'Hora Entrada', 'Turno Esperado', 'Tolerancia', 'Diferencia', 'Retardo Calculado'],
            $asistencias->map(function ($asistencia) {
                $horaEntrada = Carbon::parse($asistencia->hora_inicio);
                $horaEsperada = Carbon::parse($asistencia->fecha->format('Y-m-d') . ' ' . $asistencia->empleado->turno->hora_entrada);
                $diferencia = $horaEntrada->diffInMinutes($horaEsperada, false);
                $tolerancia = $asistencia->empleado->turno->tolerancia_minutos;
                $retardo = max(0, $diferencia - $tolerancia);

                return [
                    $asistencia->ID_asistencia,
                    $asistencia->empleado->nombre,
                    $horaEntrada->format('H:i:s'),
                    $asistencia->empleado->turno->hora_entrada,
                    $tolerancia . ' mins',
                    $diferencia . ' mins',
                    $retardo > 0 ? $retardo . ' mins' : 'Puntual'
                ];
            })
        );
    }
}
