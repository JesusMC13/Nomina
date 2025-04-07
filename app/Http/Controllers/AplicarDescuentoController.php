<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Asistencia;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AplicarDescuentoController extends Controller
{
    // Constantes para el cálculo de descuentos
    const TOLERANCIA_MINUTOS = 10; // Minutos de gracia antes de aplicar descuento
    const BLOQUE_MINUTOS = 15;     // Minutos por bloque de descuento

    // Tarifas de descuento por puesto en MXN por bloque
    const TARIFAS_DESCUENTO = [
        'Gerente' => 50,
        'Supervisor' => 40,
        'Cocinero' => 35,
        'Recepcionista' => 30,
        'Bartender' => 30,
        'Almacenista' => 25,
        'Mesero' => 25,
        'Cajero' => 25,
        'Ayudante de cocina' => 20,
        'Limpieza' => 20,
        'default' => 25
    ];

    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->format('Y-m-d'));
        $fechaFin = $request->input('fecha_fin', now()->format('Y-m-d'));

        // Obtener todos los empleados con sus retardos y calcular descuentos
        $empleados = Empleado::with(['puesto', 'turno', 'asistencias' => function($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->where('minutos_retraso', '>', 0);
        }])->get()->map(function($empleado) {
            // Calcular total de retardos
            $empleado->total_retardos = $empleado->asistencias->count();

            // Calcular total de descuentos
            $empleado->total_descuento = $empleado->asistencias->sum(function($asistencia) use ($empleado) {
                return $this->calcularDescuentoMXN($empleado, $asistencia->minutos_retraso);
            });

            return $empleado;
        });

        // Calcular resumen general
        $totalEmpleados = $empleados->count();
        $totalRetardos = $empleados->sum('total_retardos');
        $totalDescuentos = $empleados->sum('total_descuento');

        return view('adminn.aplicardescuento.index', compact(
            'empleados',
            'fechaInicio',
            'fechaFin',
            'totalEmpleados',
            'totalRetardos',
            'totalDescuentos'
        ));
    }

    // En tu controlador
    public function resultado(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->format('Y-m-d'));
        $fechaFin = $request->input('fecha_fin', now()->format('Y-m-d'));

        $resumen = Empleado::selectRaw('
            COUNT(DISTINCT empleados.ID_empleado) as total_empleados,
            COUNT(asistencia.ID_asistencia) as total_retardos,
            SUM(asistencia.minutos_retraso) as total_minutos_retraso,
            SUM(CASE
                WHEN asistencia.minutos_retraso <= ? THEN 0
                ELSE CEIL((asistencia.minutos_retraso - ?) / ?) *
                    CASE puesto.nombre_puesto
                        WHEN "Gerente" THEN 50
                        WHEN "Supervisor" THEN 40
                        WHEN "Cocinero" THEN 35
                        WHEN "Recepcionista" THEN 30
                        WHEN "Bartender" THEN 30
                        WHEN "Almacenista" THEN 25
                        WHEN "Mesero" THEN 25
                        WHEN "Cajero" THEN 25
                        WHEN "Ayudante de cocina" THEN 20
                        WHEN "Limpieza" THEN 20
                        ELSE 25
                    END
                END) as total_descuentos
        ', [
            self::TOLERANCIA_MINUTOS,
            self::TOLERANCIA_MINUTOS,
            self::BLOQUE_MINUTOS
        ])
            ->join('puesto', 'empleados.id_puesto', '=', 'puesto.id_puesto')
            ->join('asistencia', 'empleados.ID_empleado', '=', 'asistencia.ID_empleado')
            ->whereBetween('asistencia.fecha', [$fechaInicio, $fechaFin])
            ->where('asistencia.minutos_retraso', '>', 0)
            ->first();

        return view('adminn.aplicardescuento.resultado', compact('resumen', 'fechaInicio', 'fechaFin'));
    }
    public function detalle($id, Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->format('Y-m-d'));
        $fechaFin = $request->input('fecha_fin', now()->format('Y-m-d'));

        $empleado = Empleado::with(['puesto', 'turno'])->findOrFail($id);

        $retardos = Asistencia::where('ID_empleado', $id)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('minutos_retraso', '>', 0)
            ->orderBy('fecha', 'desc')
            ->get()
            ->map(function($asistencia) use ($empleado) {
                $descuento = $this->calcularDescuentoMXN($empleado, $asistencia->minutos_retraso);

                return [
                    'fecha' => Carbon::parse($asistencia->fecha)->format('d/m/Y'),
                    'turno' => $empleado->turno->nombre_turno ?? 'N/A',
                    'hora_esperada' => $empleado->turno ? Carbon::parse($empleado->turno->hora_entrada)->format('H:i') : 'N/A',
                    'hora_llegada' => Carbon::parse($asistencia->hora_inicio)->format('H:i'),
                    'minutos_retraso' => $asistencia->minutos_retraso,
                    'descuento' => $descuento,
                    'detalle_calculo' => $this->generarDetalleCalculo($empleado, $asistencia->minutos_retraso, $descuento)
                ];
            });

        return view('adminn.aplicardescuento.detalle', [
            'empleado' => $empleado,
            'retardos' => $retardos,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'total_descuento' => $retardos->sum('descuento')
        ]);
    }

    public function getRetardosEmpleado($id, Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', now()->startOfMonth()->format('Y-m-d'));
        $fechaFin = $request->input('fecha_fin', now()->format('Y-m-d'));

        $empleado = Empleado::with(['puesto', 'turno'])->findOrFail($id);

        $retardos = Asistencia::where('ID_empleado', $id)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('minutos_retraso', '>', 0)
            ->orderBy('fecha', 'desc')
            ->get()
            ->map(function($asistencia) use ($empleado) {
                $descuento = $this->calcularDescuentoMXN($empleado, $asistencia->minutos_retraso);

                return [
                    'ID_asistencia' => $asistencia->ID_asistencia,
                    'fecha' => Carbon::parse($asistencia->fecha)->format('d/m/Y'),
                    'turno' => $empleado->turno->nombre_turno ?? 'N/A',
                    'hora_esperada' => $empleado->turno ? Carbon::parse($empleado->turno->hora_entrada)->format('H:i') : 'N/A',
                    'hora_inicio' => Carbon::parse($asistencia->hora_inicio)->format('H:i'),
                    'minutos_retraso' => $asistencia->minutos_retraso,
                    'descuento' => $descuento,
                    'puesto' => $empleado->puesto->nombre_puesto ?? 'default',
                    'detalle_calculo' => $this->generarDetalleCalculo($empleado, $asistencia->minutos_retraso, $descuento)
                ];
            });

        return response()->json($retardos);
    }

    private function calcularDescuentoMXN($empleado, $minutosRetraso)
    {
        // Tolerancia de 10 minutos
        if ($minutosRetraso <= 10) {
            return 0;
        }

        // Definir tarifas por puesto
        $tarifas = [
            'Gerente' => 50,
            'Supervisor' => 40,
            'Cocinero' => 35,
            'Bartender' => 30,
            'Mesero' => 25,
            'Almacenista' => 25,
            'Ayudante de cocina' => 20,
            // Agrega otros puestos según necesites
        ];

        $puesto = $empleado->puesto->nombre_puesto ?? 'default';
        $tarifa = $tarifas[$puesto] ?? 25; // Valor por defecto

        // Calcular minutos descontables (después de tolerancia)
        $minutosDescontables = $minutosRetraso - 10;

        // Calcular bloques de 15 minutos
        $bloques = ceil($minutosDescontables / 15);

        // Calcular descuento total
        return $bloques * $tarifa;
    }
    private function generarDetalleCalculo($empleado, $minutosRetraso, $montoDescuento)
    {
        if ($minutosRetraso <= self::TOLERANCIA_MINUTOS) {
            return "Sin descuento (retardo menor a ".self::TOLERANCIA_MINUTOS." minutos)";
        }

        $puesto = $empleado->puesto->nombre_puesto ?? 'default';
        $tarifa = self::TARIFAS_DESCUENTO[$puesto] ?? self::TARIFAS_DESCUENTO['default'];
        $minutosDescontables = $minutosRetraso - self::TOLERANCIA_MINUTOS;
        $bloques = ceil($minutosDescontables / self::BLOQUE_MINUTOS);

        return sprintf(
            "Descuento: %d bloques de %d min × $%d MXN = $%d MXN (Puesto: %s, Retardo: %d min)",
            $bloques,
            self::BLOQUE_MINUTOS,
            $tarifa,
            $montoDescuento,
            $puesto,
            $minutosRetraso
        );

    }
}
