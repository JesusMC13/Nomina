<?php

namespace App\Http\Controllers;

use App\Models\Justificacion;
use App\Models\EstadoJustificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JustificacionController extends Controller
{
    public function index(Request $request)
    {
        $empleadoId = Auth::user()->empleado->ID_empleado;

        if ($request->isMethod('post')) {
            return $this->handlePostRequest($request);
        }

        $justificaciones = Justificacion::with(['estado'])
            ->where('ID_empleado', $empleadoId)
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        $estados = EstadoJustificacion::all();

        return view('empleado.justificaciones.index', compact('justificaciones', 'estados'));
    }

    public function show($id)
    {
        $justificacion = Justificacion::with(['estado'])
            ->where('ID_empleado', Auth::user()->empleado->ID_empleado)
            ->findOrFail($id);

        return view('empleado.justificaciones.show', compact('justificacion'));
    }

    protected function handlePostRequest(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date|before_or_equal:today',
            'motivo' => 'required|string|max:1000',
            'archivo' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $estadoPendiente = EstadoJustificacion::where('nombre_estado', 'Pendiente')->firstOrFail();

        $data = [
            'ID_empleado' => Auth::user()->empleado->ID_empleado,
            'fecha' => $validated['fecha'],
            'motivo' => $validated['motivo'],
            'ID_estado' => $estadoPendiente->ID_estado
        ];

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('justificaciones', 'public');
        }

        Justificacion::create($data);

        return redirect()->route('empleado.justificaciones.index')
            ->with('success', 'Justificación enviada correctamente');
    }
}
