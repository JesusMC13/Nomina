<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;

class ModificarTurnoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('turno')->get();  // 🔹 Cambié 'turnos' a 'turno'
        return view('adminn.modificar_turnos.index', compact('empleados'));
    }

    public function showModificarTurnoForm($ID_empleado)
    {
        $empleado = Empleado::with('turno')->findOrFail($ID_empleado);  // 🔹 Cambié 'turnos' a 'turno'
        $turnos = Turno::all();
        return view('adminn.modificar_turnos.form', compact('empleado', 'turnos'));
    }

    public function modificarTurno(Request $request, $ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $empleado->turno()->sync([$request->turno_id]);  // 🔹 Cambié 'turnos' a 'turno'
        return redirect()->route('adminn.modificar.turnos')->with('success', 'Turno actualizado correctamente!');
    }
}
