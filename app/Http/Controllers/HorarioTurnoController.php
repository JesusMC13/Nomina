<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Turno;
use Illuminate\Http\Request;

class HorarioTurnoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with(['puesto', 'turno'])
            ->orderBy('nombre')
            ->paginate(15);

        $puestosUnicos = Puesto::orderBy('nombre_puesto')->pluck('nombre_puesto', 'id_puesto');
        $turnosUnicos = Turno::orderBy('nombre_turno')->pluck('nombre_turno', 'ID_turno');

        return view('adminn.horarios.index', [
            'horarios' => $empleados,
            'puestosUnicos' => $puestosUnicos,
            'turnosUnicos' => $turnosUnicos
        ]);
    }

    public function buscar(Request $request)
    {
        $query = Empleado::with(['puesto', 'turno']);

        // Búsqueda por nombre completo
        if ($request->filled('nombre')) {
            $search = $request->nombre;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido_paterno', 'LIKE', "%$search%")
                    ->orWhere('apellido_materno', 'LIKE', "%$search%");
            });
        }

        // Filtro por puesto
        if ($request->filled('puesto')) {
            $query->whereHas('puesto', function($q) use ($request) {
                $q->where('id_puesto', $request->puesto);
            });
        }

        // Filtro por turno
        if ($request->filled('turno')) {
            $query->whereHas('turno', function($q) use ($request) {
                $q->where('ID_turno', $request->turno);
            });
        }

        $empleados = $query->paginate(15);
        $puestosUnicos = Puesto::orderBy('nombre_puesto')->pluck('nombre_puesto', 'id_puesto');
        $turnosUnicos = Turno::orderBy('nombre_turno')->pluck('nombre_turno', 'ID_turno');

        return view('adminn.horarios.index', [
            'horarios' => $empleados,
            'puestosUnicos' => $puestosUnicos,
            'turnosUnicos' => $turnosUnicos
        ]);
    }
}
