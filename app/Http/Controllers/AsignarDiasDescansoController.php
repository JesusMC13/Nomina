<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\DiaDescanso;
use App\Models\EmpleadoDiaDescanso;
use Illuminate\Support\Facades\DB;

class AsignarDiasDescansoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with(['diasDescanso' => function($query) {
            $query->orderBy('ID_dia_descanso');
        }])->orderBy('ID_empleado')->get();

        return view('adminn.asignardiasdescanso.index', compact('empleados'));
    }

    public function create()
    {
        $empleados = Empleado::orderBy('ID_empleado')->get();
        $dias = DiaDescanso::orderBy('ID_dia_descanso')->get();

        return view('adminn.asignardiasdescanso.create', compact('empleados', 'dias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,ID_empleado',
            'dia_descanso_id' => 'required|exists:dias_descanso,ID_dia_descanso'
        ]);

        try {
            // Verificar si ya existe la asignación
            $existe = EmpleadoDiaDescanso::where([
                'empleado_id' => $request->empleado_id,
                'dia_descanso_id' => $request->dia_descanso_id
            ])->exists();

            if ($existe) {
                return redirect()->back()->with('warning', 'Esta asignación ya existía');
            }

            EmpleadoDiaDescanso::create([
                'empleado_id' => $request->empleado_id,
                'dia_descanso_id' => $request->dia_descanso_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('adminn.asignardiasdescanso.index')
                ->with('success', 'Día de descanso asignado exitosamente');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al asignar: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $empleado = Empleado::with(['diasDescanso' => function($query) {
            $query->orderBy('ID_dia_descanso');
        }])->findOrFail($id);

        $dias = DiaDescanso::orderBy('ID_dia_descanso')->get();

        return view('adminn.asignardiasdescanso.edit', compact('empleado', 'dias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dias_descanso' => 'sometimes|array',
            'dias_descanso.*' => 'integer|exists:dias_descanso,ID_dia_descanso'
        ]);

        DB::beginTransaction();

        try {
            $empleado = Empleado::findOrFail($id);

            // Sincronizar días de descanso
            $empleado->diasDescanso()->sync($request->dias_descanso ?? []);

            DB::commit();

            return redirect()->route('adminn.asignardiasdescanso.index')
                ->with('success', 'Días de descanso actualizados correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al actualizar: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        try {
            $empleado->diasDescanso()->detach();
            return redirect()->route('adminn.asignardiasdescanso.index')
                ->with('success', 'Días de descanso eliminados correctamente');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
