<?php
// app/Http/Controllers/AsignarTurnoController.php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;

class AsignarTurnoController extends Controller
{
    // Mostrar la lista de empleados con sus turnos
    public function index()
    {
        $empleados = Empleado::with('turno')->get();  // Obtener todos los empleados con sus turnos

        return view('adminn.asignar_turnos.index', compact('empleados'));  // Pasar los empleados a la vista
    }

    // Mostrar el formulario para asignar un turno a un empleado
    public function show($ID_empleado)
    {
        $empleado = Empleado::find($ID_empleado);  // Obtener el empleado
        $turnos = Turno::all();  // Obtener todos los turnos disponibles

        return view('adminn.asignar_turnos.form', compact('empleado', 'turnos'));
    }

    // Asignar un turno al empleado
    public function asignarTurno(Request $request, $ID_empleado)
    {
        $empleado = Empleado::find($ID_empleado);  // Obtener el empleado

        // Validar el turno recibido
        $request->validate([
            'turno_id' => 'required|exists:turnos,ID_turno',  // Validar que el turno exista
        ]);

        // Asignar el nuevo turno al empleado
        $empleado->turno_id = $request->turno_id;
        $empleado->save();

        return redirect()->route('adminn.asignar.turnos')->with('success', 'Turno asignado correctamente.');
    }
}