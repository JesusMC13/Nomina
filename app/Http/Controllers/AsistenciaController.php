<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AsistenciaController extends Controller
{
    public function index()
    {
        $empleado = Auth::user()->empleado;

        if (!$empleado) {
            return view('empleado.asistencias.index')->with('asistencias', []);
        }

        $asistencias = Asistencia::where('ID_empleado', $empleado->ID_empleado)
            ->orderBy('fecha', 'desc')
            ->paginate(10); // Paginación para mejor rendimiento

        return view('empleado.asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        return view('empleado.asistencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => ['required', 'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9]\s?(AM|PM)$/i'],
            'hora_fin' => ['required', 'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9]\s?(AM|PM)$/i', 'after:hora_inicio'],
        ]);

        // Obtener el empleado relacionado al usuario
        $empleado = Auth::user()->empleado;

        if (!$empleado) {
            return back()->with('error', 'No tienes un empleado asociado.');
        }

        Asistencia::create([
            'ID_empleado' => $empleado->ID_empleado, // Usar el ID del empleado, no del usuario
            'fecha' => $request->fecha,
            'hora_inicio' => Carbon::createFromFormat('h:i A', $request->hora_inicio)->format('H:i:s'),
            'hora_fin' => Carbon::createFromFormat('h:i A', $request->hora_fin)->format('H:i:s'),
        ]);

        return redirect()->route('empleado.asistencias.index')
            ->with('success', 'Asistencia registrada correctamente.');
    }
    public function destroy($id)
    {
        $empleado = Auth::user()->empleado;
        $asistencia = Asistencia::findOrFail($id);

        if (!$empleado || $asistencia->ID_empleado != $empleado->ID_empleado) {
            return redirect()->route('empleado.asistencias.index')
                ->with('error', 'No tienes permiso para eliminar esta asistencia.');
        }

        $asistencia->delete();
        return redirect()->route('empleado.asistencias.index')
            ->with('success', 'Asistencia eliminada correctamente.');
    }
}
