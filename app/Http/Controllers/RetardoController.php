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
            ->select('asistencia.*', 'empleados.nombre', 'empleados.apellido_paterno', 'empleados.apellido_materno', 'empleados.hora_entrada', 'empleados.sueldo_total')
            ->get();

        // Filtrar los retardos y aplicar descuento si corresponde
        $retardos = $retardos->map(function ($asistencia) {
            // Aquí se calcula si hay retardo comparando la hora de entrada
            $hora_entrada = Carbon::createFromFormat('H:i:s', $asistencia->hora_entrada);
            $hora_programada = Carbon::createFromFormat('H:i:s', '09:00:00'); // Hora programada de entrada
            $hora_tolerancia = $hora_programada->copy()->addMinutes(15); // Hora con tolerancia de 15 minutos

            // Si la hora de entrada es posterior a la hora de tolerancia
            if ($hora_entrada->gt($hora_tolerancia)) {
                // Calcular los minutos de retraso
                $minutos_retraso = $hora_entrada->diffInMinutes($hora_programada);

                // Calcular el porcentaje de descuento basado en los minutos de retraso (por ejemplo, 1% por cada 10 minutos)
                $descuento = ($minutos_retraso / 10) * 0.01; // 1% por cada 10 minutos de retraso

                // Aplicar el descuento proporcional al sueldo
                $monto_descuento = $asistencia->sueldo_total * $descuento;

                // Actualizar el campo descuento aplicado
                $asistencia->descuento_aplicado = $monto_descuento;
            } else {
                $asistencia->descuento_aplicado = 0; // No se aplica descuento si no hay retardo
            }

            return $asistencia;
        });

        // Pasar los datos a la vista
        return view('adminn.retardos.index', compact('retardos'));
    }
}
