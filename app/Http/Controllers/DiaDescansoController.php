<?php

namespace App\Http\Controllers;

use App\Models\DiaDescanso;
use Illuminate\Http\Request;

class DiaDescansoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }

    public function index()
{
    $diasDescanso = DiaDescanso::all();
    return view('adminn.dias_descanso.index', compact('diasDescanso'));
}

public function create()
{
    return view('adminn.dias_descanso.create');
}

public function store(Request $request)
{
    // Validación de datos
    $data = $request->validate([
        'Nombre_Dia' => 'required|string|max:255|unique:dia_descansos', // Validación única
    ]);

    // Creación del nuevo día de descanso
    DiaDescanso::create($data);

    return redirect()->route('admin.dias_descanso.index')
        ->with('success', 'Día de descanso creado correctamente.');
}

public function show(DiaDescanso $diaDescanso)
{
    return view('adminn.dias_descanso.show', compact('diaDescanso'));
}

public function edit(DiaDescanso $diaDescanso)
{
    return view('adminn.dias_descanso.edit', compact('diaDescanso'));
}

}