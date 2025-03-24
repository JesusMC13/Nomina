<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class AsignarDiasDescansoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all(); // Obtener todos los empleados
        return view('adminn.asignar_dias_descanso.index', compact('empleados'));
    }

    public function showAsignarDescansoForm($ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $diasDescanso = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        // Inicializar los días de descanso del empleado como un array vacío si es nulo
        $diasDescansoAsignados = json_decode($empleado->dias_descanso ?? '[]', true);

        return view('adminn.asignar_dias_descanso.form', compact('empleado', 'diasDescanso', 'diasDescansoAsignados'));
    }

    public function asignarDescanso(Request $request, $ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $empleado->dias_descanso = json_encode($request->input('dias_descanso', [])); // Asegura que siempre sea un array

        $empleado->save();

        return redirect()->route('adminn.asignar.dias.descanso')->with('success', 'Días de descanso asignados correctamente!');
    }
}
