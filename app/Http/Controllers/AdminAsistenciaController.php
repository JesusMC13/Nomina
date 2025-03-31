<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

class AdminAsistenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las asistencias con la relación "empleado"
        $asistencias = Asistencia::with('empleado')
            ->orderBy('fecha', 'desc')
            ->get();

        // Retornar la vista con las asistencias
        return view('adminn.asistencias.index', compact('asistencias')); // Ajustar la ruta de la vista
    }
}
