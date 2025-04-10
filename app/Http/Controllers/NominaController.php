<?php

namespace App\Http\Controllers;

use App\Models\Nomina;
use App\Models\Empleado;
use App\Models\Asistencia;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NominaController extends Controller
{
    public function index() {
        $empleado = Empleado::with(['user', 'puesto'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Obtener nóminas con descuentos relacionados
        $nominas = $empleado->nominas()
            ->with(['descuentos' => function($query) {
                $query->where('visible_empleado', true);
            }])
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(10);

        // Calcular totales para cada nómina
        $nominas->each(function($nomina) {
            $nomina->total_descuentos = $nomina->descuentos->sum('monto');
            $nomina->sueldo_neto = $nomina->sueldo_base - $nomina->total_descuentos;
        });

        return view('empleado.nominas.index', [
            'nominas' => $nominas,
            'empleado' => $empleado,
            'sueldoSemanal' => $empleado->puesto->salario_base,
            'sueldoDiario' => round($empleado->puesto->salario_base / 6, 2)
        ]);
    }

    public function show(Nomina $nomina)
    {
        $empleado = Empleado::where('user_id', Auth::id())->firstOrFail();

        if ($nomina->ID_empleado != $empleado->ID_empleado) {
            abort(403, 'No autorizado');
        }

        // Cargar descuentos visibles para el empleado
        $nomina->load(['descuentos' => function($query) {
            $query->where('visible_empleado', true);
        }]);

        return view('empleado.nominas.show', [
            'nomina' => $nomina,
            'totalDescuentos' => $nomina->descuentos->sum('monto'),
            'sueldoNeto' => $nomina->sueldo_base - $nomina->descuentos->sum('monto')
        ]);
    }

    // Método para generar nómina (admin)
    public function generarNomina(Request $request)
    {
        $empleado = Empleado::with('puesto')->find($request->empleado_id);

        // 1. Calcular días trabajados
        $diasTrabajados = Asistencia::where('ID_empleado', $empleado->ID_empleado)
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->where('asistio', true)
            ->count();

        // 2. Calcular sueldo base
        $sueldoSemanal = $empleado->puesto->salario_base;
        $sueldoDiario = $sueldoSemanal / 6;
        $sueldoBase = $sueldoDiario * $diasTrabajados;

        // 3. Obtener descuentos del periodo
        $descuentos = Descuento::where('ID_empleado', $empleado->ID_empleado)
            ->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])
            ->where('aplicado_en_nomina', false)
            ->get();

        $totalDescuentos = $descuentos->sum('monto');

        // 4. Crear nómina
        $nomina = Nomina::create([
            'ID_empleado' => $empleado->ID_empleado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'periodo' => 'semanal',
            'dias_trabajados' => $diasTrabajados,
            'sueldo_base' => $sueldoBase,
            'total_descuentos' => $totalDescuentos,
            'sueldo_neto' => $sueldoBase - $totalDescuentos,
            'fecha_pago' => now()->next(Carbon::MONDAY),
            'estado' => 'pendiente'
        ]);

        // 5. Actualizar descuentos como aplicados
        Descuento::whereIn('ID_descuento', $descuentos->pluck('ID_descuento'))
            ->update(['aplicado_en_nomina' => true, 'ID_nomina' => $nomina->id]);

        return redirect()->back()->with('success', "Nómina generada: $".number_format($nomina->sueldo_neto, 2));
    }
}
