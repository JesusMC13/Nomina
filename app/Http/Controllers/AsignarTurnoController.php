<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class AsignarTurnoController extends Controller
{
    // Muestra la lista de empleados
    public function index()
    {
        $empleados = Empleado::all(); // Obtiene todos los empleados
        return view('adminn.asignar_turnos.index', compact('empleados')); // Pasa la lista a la vista
    }

    // Muestra el formulario para asignar turno a un empleado específico
    public function showAsignarTurnoForm($ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado); // Obtiene el empleado por su ID
        return view('adminn.asignar_turnos.form', compact('empleado')); // Muestra el formulario con los datos del empleado
    }

    // Asigna el turno al empleado
    public function asignarTurno(Request $request, $ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado); // Encuentra al empleado por su ID
        $empleado->turno = $request->turno; // Asigna el turno recibido del formulario
        $empleado->save(); // Guarda los cambios en la base de datos

        // Redirige con un mensaje de éxito
        return redirect()->route('adminn.asignar.turnos')->with('success', 'Turno asignado correctamente!');
    }
}
