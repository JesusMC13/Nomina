<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\DiaDescanso;

class AsignarDiasDescansoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('diasDescanso')->get();
        return view('adminn.asignardiasdescanso.index', compact('empleados'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $dias = DiaDescanso::all();
        return view('adminn.asignardiasdescanso.create', compact('empleados', 'dias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,ID_empleado',
            'dias_descanso' => 'required|array',
            'dias_descanso.*' => 'exists:dias_descanso,ID_dia_descanso',
        ]);

        $empleado = Empleado::findOrFail($request->empleado_id);
        $empleado->diasDescanso()->sync($request->dias_descanso);

        return redirect()->route('adminn.asignardiasdescanso.index')->with('success', 'Días de descanso asignados correctamente.');
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
