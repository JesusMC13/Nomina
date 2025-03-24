<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class ModificarTurnoController extends Controller
{
    // Muestra la lista de empleados con sus turnos
    public function index()
    {
        $empleados = Empleado::all();
        return view('adminn.modificar_turnos.index', compact('empleados'));
    }

    // Muestra el formulario para modificar el turno
    public function showModificarTurnoForm($ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        return view('adminn.modificar_turnos.form', compact('empleado'));
    }

    // Modifica el turno del empleado
    public function modificarTurno(Request $request, $ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $empleado->turno = $request->turno;
        $empleado->save();

        return redirect()->route('adminn.modificar.turnos')->with('success', 'Turno actualizado correctamente!');
    }
}
