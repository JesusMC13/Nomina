<?php

namespace App\Http\Controllers;
use App\Models\Asistencia;
use App\Models\VistaAsistenciaEmpleado;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        // Consultar todas las asistencias
        $asistencias = Asistencia::with('empleado')->get();

        // Retornar la vista con los resultados
        return view('adminn.asistencias.index', compact('asistencias'));
    }
}

