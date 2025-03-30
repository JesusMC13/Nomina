<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function index()
    {
        $empleado = Auth::user();
        $asistencias = Asistencia::where('ID_empleado', $empleado->id)->orderBy('fecha', 'desc')->get();
        return view('empleado.asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        return view('empleado.asistencias.create');
    }

    public function store(Request $request)
{
    // Validación de las horas en formato 12 horas con AM/PM
    $request->validate([
        'fecha' => 'required|date',
        'hora_inicio' => 'required|date_format:h:i A',  // Formato de 12 horas para hora_inicio
        'hora_fin' => 'required|date_format:h:i A|after:hora_inicio',  // Formato de 12 horas para hora_fin y asegurarse de que hora_fin sea después de hora_inicio
    ]);

    // Convertir las horas de 12 horas (AM/PM) a formato de 24 horas
    $hora_inicio = Carbon::createFromFormat('h:i A', $request->hora_inicio)->format('H:i:s');
    $hora_fin = Carbon::createFromFormat('h:i A', $request->hora_fin)->format('H:i:s');

    // Crear la asistencia en la base de datos
    Asistencia::create([
        'ID_empleado' => Auth::user()->id,
        'fecha' => $request->fecha,
        'hora_inicio' => $hora_inicio,
        'hora_fin' => $hora_fin,
    ]);

    return redirect()->route('empleado.asistencias.index')->with('success', 'Asistencia registrada correctamente.');
}


    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        if ($asistencia->ID_empleado == Auth::user()->id) {
            $asistencia->delete();
            return redirect()->route('empleado.asistencias.index')->with('success', 'Asistencia eliminada.');
        }
        return redirect()->route('empleado.asistencias.index')->with('error', 'No puedes eliminar esta asistencia.');
    }
}
