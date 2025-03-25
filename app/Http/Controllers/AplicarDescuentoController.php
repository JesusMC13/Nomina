<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\AsignarTurno;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AplicarDescuentoController extends Controller
{
    // Método para mostrar la vista
    public function index()
    {
        $empleados = Empleado::with('puesto', 'turno')->get(); // Obtén los empleados con sus puestos y turnos
    
        return view('adminn.aplicardescuento.index', compact('empleados'));
    }

    // Método para aplicar el descuento
    public function aplicarDescuento(Request $request)
    {
        // Obtener empleado seleccionado
        $empleado = Empleado::find($request->empleado_id);
        $minutos_retraso = $request->minutos_retraso;
        
        // Calcular el descuento
        $descuento = $this->calcularDescuento($empleado, $minutos_retraso);
    
        // Guardar el descuento en la sesión para redirigir con los datos
        return redirect()->route('adminn.aplicardescuento.resultado')
                         ->with('empleado', $empleado)
                         ->with('descuento', $descuento);
    }
    
    // Método para calcular el descuento basado en el puesto y los minutos de retraso
    private function calcularDescuento($empleado, $minutos_retraso)
    {
        $descuento = 0;
        
        // Define los descuentos según el puesto
        if ($empleado->puesto && $empleado->puesto->nombre_puesto == 'Cocinero') {
            $descuento = 0.05; // 5% de descuento
        } elseif ($empleado->puesto && $empleado->puesto->nombre_puesto == 'Mesero') {
            $descuento = 0.03; // 3% de descuento
        } elseif ($empleado->puesto && $empleado->puesto->nombre_puesto == 'Supervisor') {
            $descuento = 0.04; // 4% de descuento
        } elseif ($empleado->puesto && $empleado->puesto->nombre_puesto == 'Gerente') {
            $descuento = 0.02; // 2% de descuento
        }

        // Aplicar el descuento proporcionalmente al tiempo de retraso
        $montoDescuento = ($empleado->sueldo_total * $descuento) * ($minutos_retraso / 60); 

        return $montoDescuento;
    }

    public function resultado()
    {
        // Obtener los datos del empleado y el descuento aplicado
        $empleado = session('empleado');
        $descuento = session('descuento');

        // Retornar la vista con los datos
        return view('adminn.aplicardescuento.resultado', compact('empleado', 'descuento'));
    }
}
