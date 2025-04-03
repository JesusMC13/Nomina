<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsignarTurnoController extends Controller
{
    // Mostrar lista de empleados con sus turnos
    public function index()
    {
        $empleados = Empleado::with('turno')->get();

        // Log para depuración
        foreach ($empleados as $empleado) {
            Log::info("Empleado ID: {$empleado->ID_empleado}, Nombre: {$empleado->nombre}, Turno: " .
                ($empleado->turno ? $empleado->turno->nombre_turno : 'No asignado'));
        }

        return view('adminn.asignar_turnos.index', compact('empleados'));
    }

    // Mostrar formulario para asignar turno
    public function show($ID_empleado)
    {
        $empleado = Empleado::findOrFail($ID_empleado);
        $turnos = Turno::all();

        return view('adminn.asignar_turnos.form', [
            'empleado' => $empleado,
            'turnos' => $turnos
        ]);
    }

    // Asignar turno al empleado
    public function asignarTurno(Request $request, $ID_empleado)
    {
        $request->validate([
            'turno_id' => 'required|exists:turnos,ID_turno'
        ]);

        try {
            $empleado = Empleado::findOrFail($ID_empleado);
            $empleado->turno_id = $request->turno_id;
            $empleado->save();

            return redirect()->route('adminn.asignar.turnos')
                ->with('success', 'Turno asignado correctamente');

        } catch (\Exception $e) {
            Log::error("Error asignando turno: " . $e->getMessage());
            return back()->with('error', 'Error al asignar el turno');
        }
    }
}
