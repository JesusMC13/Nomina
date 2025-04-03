<?php

namespace App\Console\Commands;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FixAsistenciasCommand extends Command
{
    protected $signature = 'asistencias:fix
                            {--force : Forzar recálculo incluso si ya tiene valores}
                            {--chunk=500 : Cantidad de registros a procesar por lote}';

    protected $description = 'Corrige formatos de fecha/hora y recalcula retardos y descuentos';

    public function handle()
    {
        $asistencias = Asistencia::with(['empleado.turno', 'empleado.puesto'])
            ->whereNotNull('hora_inicio')
            ->get();

        $this->table(
            ['ID', 'Empleado', 'Turno', 'Hora Entrada', 'Hora Esperada', 'Tolerancia', 'Diferencia', 'Retardo'],
            $asistencias->map(function ($asistencia) {
                $horaEntrada = Carbon::parse($asistencia->hora_inicio)->format('H:i:s');
                $horaEsperada = $asistencia->empleado->turno->hora_entrada;

                $entrada = Carbon::createFromTimeString($horaEntrada);
                $esperada = Carbon::createFromTimeString($horaEsperada);

                $diferencia = $entrada->diffInMinutes($esperada, false);
                $tolerancia = $asistencia->empleado->turno->tolerancia_minutos;
                $retardo = max(0, $diferencia - $tolerancia);

                return [
                    $asistencia->ID_asistencia,
                    $asistencia->empleado->nombre,
                    $asistencia->empleado->turno->nombre_turno,
                    $horaEntrada,
                    $horaEsperada,
                    $tolerancia . ' mins',
                    $diferencia . ' mins',
                    $retardo > 0 ? $retardo . ' mins' : 'Puntual'
                ];
            })
        );
    }
}
