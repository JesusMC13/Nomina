<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoAsistenciaController extends Controller
{
    public function index()
    {
        // Obtener las asistencias de los empleados
        $asistencias = Asistencia::join('empleados', 'asistencias.ID_empleado', '=', 'empleados.ID_empleado')
            ->select('asistencias.*', 'empleados.nombre', 'empleados.apellido_paterno', 'empleados.apellido_materno')
            ->get();

        return view('adminn.asistencias.index', compact('asistencias'));
    }
}

