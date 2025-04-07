<?php

namespace App\Http\Controllers;

use App\Models\Justificacion;
use App\Models\EstadoJustificacion;
use Illuminate\Http\Request;

class AdminJustificacionController extends Controller
{
    public function index()
    {
        $justificaciones = Justificacion::with(['empleado', 'estado'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $estados = EstadoJustificacion::all();

        return view('adminn.justificaciones.index', compact('justificaciones', 'estados'));
    }

    public function show($id)
    {
        $justificacion = Justificacion::with(['empleado', 'estado'])->findOrFail($id);
        return view('adminn.justificaciones.show', compact('justificacion'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:2,3' // 2: Aprobado, 3: Rechazado
        ]);

        try {
            $justificacion = Justificacion::findOrFail($id);
            $justificacion->update([
                'ID_estado' => $request->estado
            ]);

            return redirect()->route('adminn.justificaciones.index')
                ->with('success', 'Estado actualizado correctamente');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }
}
