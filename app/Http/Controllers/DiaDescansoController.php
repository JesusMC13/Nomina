<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class DiaDescansoController extends Controller
{
    // Muestra la lista de días de descanso para todos los empleados
    public function index()
    {
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return view('adminn.dias_descanso.index', compact('dias'));
    }

    // Muestra el formulario para asignar días de descanso a un empleado
    public function asignarDescanso($ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        return view('adminn.dias_descanso.form', compact('empleado', 'dias'));
    }

    // Guarda los días de descanso asignados a un empleado
    public function guardarDescanso(Request $request, $ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $empleado->dias_descanso = json_encode($request->dias_descanso);
        $empleado->save();

        return redirect()->route('adminn.dias.descanso')->with('success', 'Días de descanso asignados correctamente');
    }
}
