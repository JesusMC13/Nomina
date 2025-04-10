<?php

namespace App\Http\Controllers;

use App\Models\Descuento;
use App\Models\Empleado;
use App\Models\Asistencia; // Añade esta línea al inicio del archivo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DescuentosController extends Controller
{
    // Configuración de tolerancia y bloques
    const TOLERANCIA_MINUTOS = 15;  // Aumentamos a 15 minutos de tolerancia
    const BLOQUE_MINUTOS = 15;      // Bloques de 15 minutos

    // Tarifas de descuento (puedes mantenerlas igual o ajustar)
    const TARIFAS_DESCUENTO = [
        'Gerente' => 50,
        'Supervisor' => 40,
        'Cocinero' => 35,
        'default' => 25
    ];
    /**
     * Muestra los descuentos del empleado autenticado
     */
    // En DescuentosController.php
    public function index()
    {
        $empleado = Empleado::where('user_id', Auth::id())->firstOrFail();

        // Obtener descuentos registrados
        $descuentosRegistrados = Descuento::with('empleado')
            ->where('ID_empleado', $empleado->ID_empleado)
            ->visible()
            ->get();

        // Obtener descuentos por retardos
        $descuentosRetardos = $this->calcularDescuentosPorRetardos($empleado);

        // Combinar y convertir a paginación manual
        $descuentos = new \Illuminate\Pagination\LengthAwarePaginator(
            $descuentosRegistrados->concat($descuentosRetardos)->sortByDesc('fecha'),
            $descuentosRegistrados->count() + $descuentosRetardos->count(),
            10,
            \Illuminate\Pagination\Paginator::resolveCurrentPage(),
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('empleado.descuentos.index', [
            'descuentos' => $descuentos,
            'empleado' => $empleado,
            'tieneDescuentos' => $descuentos->isNotEmpty()
        ]);
    }
    private function calcularDescuentosPorRetardos($empleado)
    {
        return Asistencia::where('ID_empleado', $empleado->ID_empleado)
            ->where('minutos_retraso', '>', self::TOLERANCIA_MINUTOS)
            ->whereDoesntHave('descuentos') // Que no tenga ya un descuento registrado
            ->get()
            ->map(function($asistencia) use ($empleado) {
                $monto = $this->calcularDescuento($empleado, $asistencia->minutos_retraso);

                return (object)[
                    'ID_descuento' => 'temp-' . $asistencia->ID_asistencia,
                    'ID_empleado' => $empleado->ID_empleado,
                    'monto' => $monto,
                    'tipo_descuento' => 'retardo',
                    'fecha' => $asistencia->fecha,
                    'origen' => 'retardo',
                    'ID_asistencia' => $asistencia->ID_asistencia,
                    'comentarios' => 'Descuento automático por retardo',
                    'es_calculado' => true, // Para identificar en la vista
                    'minutos_retraso' => $asistencia->minutos_retraso
                ];
            });
    }
    private function calcularDescuento($empleado, $minutosRetraso)
    {
        // Aplicar tolerancia de 15 minutos para todos
        if ($minutosRetraso <= self::TOLERANCIA_MINUTOS) {
            return 0;
        }

        $puesto = $empleado->puesto->nombre_puesto ?? 'default';
        $tarifa = self::TARIFAS_DESCUENTO[$puesto] ?? self::TARIFAS_DESCUENTO['default'];

        // Calcular minutos descontables (después de los 15 de tolerancia)
        $minutosDescontables = $minutosRetraso - self::TOLERANCIA_MINUTOS;

        // Calcular bloques de 15 minutos
        $bloques = ceil($minutosDescontables / self::BLOQUE_MINUTOS);

        return $bloques * $tarifa;
    }

    /**
     * Muestra el detalle de un descuento específico
     */
    public function show($id)
    {
        // Si es un descuento temporal (calculado)
        if (str_starts_with($id, 'temp-')) {
            $asistenciaId = str_replace('temp-', '', $id);
            $asistencia = Asistencia::findOrFail($asistenciaId);
            $empleado = Empleado::findOrFail($asistencia->ID_empleado);

            $descuento = (object)[
                'ID_descuento' => $id,
                'monto' => $this->calcularDescuento($empleado, $asistencia->minutos_retraso),
                'tipo_descuento' => 'retardo',
                'fecha' => $asistencia->fecha,
                'origen' => 'retardo',
                'comentarios' => 'Descuento automático por retardo',
                'es_calculado' => true,
                'minutos_retraso' => $asistencia->minutos_retraso,
                'empleado' => $empleado,
                'asistencia' => $asistencia
            ];

            return view('empleado.descuentos.show', compact('descuento'));
        }

        // Descuento registrado
        $descuento = Descuento::with(['empleado', 'asistencia'])
            ->where('ID_descuento', $id)
            ->where('ID_empleado', Auth::user()->empleado->ID_empleado)
            ->firstOrFail();

        return view('empleado.descuentos.show', compact('descuento'));
    }
    public static function generarDetalleCalculo($empleado, $minutosRetraso, $montoDescuento)
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
