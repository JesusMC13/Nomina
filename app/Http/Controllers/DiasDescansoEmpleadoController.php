<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class DiasDescansoEmpleadoController extends Controller
{
    public function index()
    {
        // Obtener el empleado autenticado con sus días de descanso
        $empleado = Auth::user()->empleado()->with(['puesto', 'diasDescanso'])->firstOrFail();

        return view('empleado.dias-descanso.index', compact('empleado'));
    }
}
