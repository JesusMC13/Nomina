<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RetardoController extends Controller
{
    public function index()
    {
        // Obtener las asistencias de los empleados
        $retardos = Asistencia::join('empleados', 'asistencia.ID_empleado', '=', 'empleados.ID_empleado')
            ->select('asistencia.*', 'empleados.nombre', 'empleados.apellido_paterno', 'empleados.apellido_materno')
            ->get();

        // Filtrar los retardos
        $retardos = $retardos->filter(function ($asistencia) {
            // Aquí se calcula si hay retardo comparando la hora de entrada
            $hora_entrada = Carbon::createFromFormat('H:i:s', $asistencia->hora_inicio);
            $hora_programada = Carbon::createFromFormat('H:i:s', '09:00:00'); // Hora programada de entrada

            // Comparar si la hora de entrada es después de la hora programada
            return $hora_entrada->gt($hora_programada);
        });

        return view('adminn.retardos.index', compact('retardos'));
    }
}
