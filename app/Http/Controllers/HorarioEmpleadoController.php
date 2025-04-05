<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;

class HorarioEmpleadoController extends Controller
{
    public function index()
    {
        // Obtener el empleado autenticado a través de la relación con User
        $empleado = Auth::user()->empleado()->with(['puesto', 'turno'])->firstOrFail();

        return view('empleado.horarios.index', compact('empleado'));
    }

    public function create()
    {
        // Solo si necesitas que el empleado pueda solicitar cambios de horario
        $turnos = Turno::all();
        return view('empleado.horarios.create', compact('turnos'));
    }

    public function store(Request $request)
    {
        // Lógica para solicitar cambio de horario (si aplica)
        // Esto sería opcional según tus requerimientos
    }

    public function destroy($id)
    {
        // Lógica para eliminar solicitud de cambio (si aplica)
        // Esto sería opcional según tus requerimientos
    }
}
