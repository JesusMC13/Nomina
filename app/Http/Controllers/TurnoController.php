<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade

class TurnoController extends Controller
{
    // Mostrar la lista de turnos
    public function index()
    {
        $turnos = Turno::all();  // Obtener todos los turnos
        return view('adminn.turnos.index', compact('turnos'));
    }

    // Mostrar el formulario de creación de turno
    public function create()
    {
        return view('adminn.turnos.create');
    }

    // Almacenar el nuevo turno
    public function store(Request $request)
    {

        $request->validate([
            'nombre_turno' => 'required|string|max:50|unique:turnos,nombre_turno',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida'  => 'required|date_format:H:i',
        ]);

        Turno::create([
            'nombre_turno' => $request->nombre_turno,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida'  => $request->hora_salida,
        ]);

        return redirect()->route('adminn.turnos.index')->with('success', 'Turno creado exitosamente.');
    }

    // Mostrar el formulario de edición de turno
    public function edit(Turno $turno)
    {
        return view('adminn.turnos.edit', compact('turno'));
    }

    // Actualizar el turno
    public function update(Request $request, Turno $turno)
    {
         Log::info('Update method called'); // Add log
        $request->validate([
            'nombre_turno' => 'required|string|max:50|unique:turnos,nombre_turno,' . $turno->ID_turno . ',ID_turno',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida'  => 'required|date_format:H:i',
        ]);

        // Log the request data
        Log::info('Request Data:', $request->all());

        $turno->nombre_turno = $request->input('nombre_turno');
        $turno->hora_entrada = $request->input('hora_entrada');
        $turno->hora_salida = $request->input('hora_salida');
        $turno->save();  // Use save() method to persist changes

        return redirect()->route('adminn.turnos.index')->with('success', 'Turno actualizado exitosamente.');
    }

    // Eliminar un turno
    public function destroy(Turno $turno)
    {
        $turno->delete();

        return redirect()->route('adminn.turnos.index')->with('success', 'Turno eliminado exitosamente.');
    }
    // Agregar método show en TurnoController
    public function show(Turno $turno)
    {
        return view('adminn.turnos.show', compact('turno'));  // Pasamos el turno a la vista
    }
}
