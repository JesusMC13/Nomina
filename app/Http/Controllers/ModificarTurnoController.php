<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModificarTurnoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('turnos')->get();
        return view('adminn.modificar_turnos.index', compact('empleados'));
    }

    public function showModificarTurnoForm($ID_empleado)
    {
        $empleado = Empleado::with('turnos')->findOrFail($ID_empleado);
        $turnos = Turno::all();

        return view('adminn.modificar_turnos.form', [
            'empleado' => $empleado,
            'turnos' => $turnos
        ]);
    }

    public function modificarTurno(Request $request, $ID_empleado)
    {
        $request->validate([
            'turno_id' => 'required|exists:turnos,ID_turno'
        ]);

        try {
            $empleado = Empleado::findOrFail($ID_empleado);

            // Sincronizar la relación muchos a muchos
            $empleado->turnos()->sync([$request->turno_id]);

            return redirect()->route('adminn.modificar.turnos')
                ->with('success', 'Turno actualizado correctamente');

        } catch (\Exception $e) {
            Log::error("Error modificando turno: " . $e->getMessage());
            return back()->with('error', 'Error al actualizar el turno');
        }
    }
}
