<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();  // Obtiene todos los empleados sin relaciones
        return view('adminn.empleados.index', compact('empleados'));  // Pasa los empleados a la vista
    }

}
