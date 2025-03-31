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
        // Obtener las asistencias del empleado autenticado
        $empleado = Auth::user();
        $asistencias = Asistencia::where('ID_empleado', $empleado->id)
            ->orderBy('fecha', 'desc')
            ->get();

        // Retornar la vista con las asistencias
        return view('empleado.asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        return view('empleado.asistencias.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => ['required', 'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9]\s?(AM|PM)$/i'],
            'hora_fin' => ['required', 'regex:/^(1[0-2]|0?[1-9]):[0-5][0-9]\s?(AM|PM)$/i', 'after:hora_inicio'],
        ]);

        // Convertir las horas de 12 horas a formato de 24 horas
        $hora_inicio = Carbon::createFromFormat('h:i A', $request->hora_inicio)->format('H:i:s');
        $hora_fin = Carbon::createFromFormat('h:i A', $request->hora_fin)->format('H:i:s');

        // Crear la asistencia en la base de datos
        Asistencia::create([
            'ID_empleado' => Auth::user()->id,
            'fecha' => $request->fecha,
            'hora_inicio' => $hora_inicio,
            'hora_fin' => $hora_fin,
        ]);

        return redirect()->route('empleado.asistencias.index')
            ->with('success', 'Asistencia registrada correctamente.');
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);

        // Verificar si el empleado puede eliminar la asistencia
        if ($asistencia->ID_empleado == Auth::user()->id) {
            $asistencia->delete();
            return redirect()->route('empleado.asistencias.index')
                ->with('success', 'Asistencia eliminada.');
        }

        return redirect()->route('empleado.asistencias.index')
            ->with('error', 'No puedes eliminar esta asistencia.');
    }
}
