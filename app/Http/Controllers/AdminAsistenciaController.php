<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Http\Request;

class AdminAsistenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las asistencias con la relación "empleado" ordenadas
        $asistencias = Asistencia::with(['empleado' => function($query) {
            $query->orderBy('apellido_paterno')->orderBy('nombre');
        }])
            ->orderBy('fecha', 'desc')
            ->paginate(15); // Usar paginación en lugar de get()

        // Obtener lista de empleados para filtros
        $empleados = Empleado::orderBy('apellido_paterno')
            ->orderBy('nombre')
            ->get(['ID_empleado', 'nombre', 'apellido_paterno']);

        return view('adminn.asistencias.index', compact('asistencias', 'empleados'));
    }
}
