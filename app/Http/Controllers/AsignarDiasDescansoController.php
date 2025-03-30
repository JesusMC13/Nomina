<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\DiaDescanso;
use App\Models\EmpleadoDiaDescanso;


class AsignarDiasDescansoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('diasDescanso')->get();
        return view('adminn.asignardiasdescanso.index', compact('empleados'));
    }

    public function create()
{
    // Ordenar empleados por ID
    $empleados = Empleado::orderBy('ID_empleado', 'asc')->get();

    // Ordenar días de descanso por ID
    $dias = DiaDescanso::orderBy('ID_dia_descanso', 'asc')->get();

    return view('adminn.asignardiasdescanso.create', compact('empleados', 'dias'));
}

    
    

    // app/Http/Controllers/AsignarDiasDescansoController.php
    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,ID_empleado',
            'dia_descanso_id' => 'required|exists:dias_descanso,ID_dia_descanso',
        ]);

        // Crear la asignación de día de descanso
        $asignacion = new EmpleadoDiaDescanso();
        $asignacion->empleado_id = $request->empleado_id;
        $asignacion->dia_descanso_id = $request->dia_descanso_id;

        try {
            $asignacion->save();
            return redirect()->route('adminn.asignardiasdescanso.index')->with('success', 'Día de descanso asignado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al asignar el día de descanso.']);
        }
    }



    public function edit($id)
    {
        $empleado = Empleado::with('diasDescanso')->findOrFail($id);
        $dias = DiaDescanso::all();
        return view('adminn.asignardiasdescanso.edit', compact('empleado', 'dias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dias_descanso' => 'required|array',
            'dias_descanso.*' => 'exists:dias_descanso,ID_dia_descanso',
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->diasDescanso()->sync($request->dias_descanso);

        return redirect()->route('adminn.asignardiasdescanso.index')->with('success', 'Días de descanso actualizados correctamente.');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->diasDescanso()->detach();

        return redirect()->route('adminn.asignardiasdescanso.index')->with('success', 'Días de descanso eliminados correctamente.');
    }
}
