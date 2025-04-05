<?php

namespace App\Http\Controllers;

use App\Models\Justificacion;
use App\Models\EstadoJustificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JustificacionController extends Controller
{
    public function index(Request $request)
    {
        $empleado = Auth::user()->empleado;

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'fecha' => 'required|date|before_or_equal:today',
                'motivo' => 'required|string|max:1000'
            ]);

            $estadoPendiente = EstadoJustificacion::where('nombre_estado', 'Pendiente')->first();

            if (!$estadoPendiente) {
                return back()->with('error', 'No se pudo determinar el estado de la justificación');
            }

            Justificacion::create([
                'ID_empleado' => $empleado->ID_empleado,
                'fecha' => $validated['fecha'],
                'motivo' => $validated['motivo'],
                'ID_estado' => $estadoPendiente->ID_estado
            ]);

            return redirect()->route('empleado.justificaciones.index')
                ->with('success', 'Justificación registrada correctamente');
        }

        $justificaciones = Justificacion::with('estado')
            ->where('ID_empleado', $empleado->ID_empleado)
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('empleado.justificaciones.index', compact('justificaciones'));
    }
}
