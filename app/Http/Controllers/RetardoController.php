<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RetardoController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with(['empleado.puesto', 'empleado.turno'])
            ->whereHas('empleado', function($query) {
                $query->whereNotNull('turno_id');
            })
            ->whereNotNull('hora_inicio')
            ->where('minutos_retraso', '>', 0)
            ->orderBy('fecha', 'desc')
            ->orderBy('minutos_retraso', 'desc')
            ->paginate(15);

        return view('adminn.retardos.index', compact('asistencias'));
    }

    public function calcularRetardo()
    {
        if (!$this->empleado || !$this->empleado->turno) {
            $this->minutos_retraso = 0;
            return;
        }

        $horaEntradaTurno = \Carbon\Carbon::createFromFormat('H:i:s', $this->empleado->turno->hora_entrada);
        $horaEntradaReal = \Carbon\Carbon::createFromFormat('H:i:s', $this->hora_inicio);

        // Considerar solo días laborales
        if (!$this->esDiaLaboral()) {
            $this->minutos_retraso = 0;
            return;
        }

        // Calcular diferencia en minutos
        $this->minutos_retraso = $horaEntradaReal->diffInMinutes($horaEntradaTurno, false);

        // Solo considerar como retraso si es positivo
        if ($this->minutos_retraso < 0) {
            $this->minutos_retraso = 0;
        }
    }

    protected function esDiaLaboral()
    {
        if (!$this->empleado || !$this->empleado->turno) {
            return false;
        }

        $diasTurno = explode(',', $this->empleado->turno->dias_laborales);
        $diaSemana = $this->fecha->dayOfWeek; // 0 (domingo) a 6 (sábado)

        return in_array($diaSemana, $diasTurno);
    }
    public function actualizarTodo()
    {
        $asistencias = Asistencia::with(['empleado.turno', 'empleado.puesto'])
            ->whereNotNull('hora_inicio')
            ->get();

        $actualizados = 0;

        foreach ($asistencias as $asistencia) {
            try {
                $originalRetraso = $asistencia->minutos_retraso;

                // Forzar recálculo del retardo
                $asistencia->calcularRetardo();

                if ($asistencia->minutos_retraso != $originalRetraso) {
                    $asistencia->save();
                    $actualizados++;

                    Log::info("Retardo actualizado", [
                        'id' => $asistencia->ID_asistencia,
                        'empleado' => $asistencia->empleado->nombre,
                        'retraso_anterior' => $originalRetraso,
                        'retraso_actual' => $asistencia->minutos_retraso
                    ]);
                }
            } catch (\Exception $e) {
                Log::error("Error actualizando retardo", [
                    'id' => $asistencia->ID_asistencia,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return redirect()
            ->route('adminn.retardos.index')
            ->with('success', "Se recalcularon {$actualizados} registros de retardos.");
    }
}
