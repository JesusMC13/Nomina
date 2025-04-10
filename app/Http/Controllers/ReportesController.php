<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\ReporteNomina;
use App\Models\Descuento;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesController extends Controller
{
    public function index()
    {
        return redirect()->route('adminn.reportes.generar');
    }

    public function generar()
    {
        $ultimoReporte = Schema::hasTable('reporte_nominas')
            ? ReporteNomina::latest()->first()
            : null;

        $empleados = Empleado::with(['puesto' => function($query) {
            $query->select('id_puesto', 'nombre_puesto', 'salario_base');
        }])
            ->whereHas('user')
            ->orderBy('nombre')
            ->get([
                'ID_empleado',
                'nombre',
                'apellido_paterno',
                'apellido_materno',
                'id_puesto',
                'sueldo_diario',
                'hora_entrada',
                'turno_id'
            ]);

        // Obtener semanas con datos de asistencia
        $semanasConDatos = Asistencia::select(
            DB::raw('YEAR(fecha) as year'),
            DB::raw('WEEK(fecha, 1) as week'),
            DB::raw('MIN(fecha) as start_date'),
            DB::raw('MAX(fecha) as end_date')
        )
            ->groupBy('year', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('week', 'desc')
            ->get();

        return view('adminn.reportes.generar', compact('ultimoReporte', 'empleados', 'semanasConDatos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,ID_empleado',
            'semana' => 'required|integer|between:1,53',
            'confirmacion' => 'required|accepted'
        ]);

        return DB::transaction(function () use ($request) {
            $empleado = Empleado::with('puesto', 'diasDescanso')
                ->findOrFail($request->empleado_id);

            // Obtener el año actual
            $year = now()->year;

            // Calcular fechas basadas en semana del año
            $inicioSemana = Carbon::createFromFormat('Y-m-d', $year.'-01-01')
                ->addWeeks($request->semana - 1)
                ->startOfWeek();
            $finSemana = $inicioSemana->copy()->endOfWeek();

            // Verificar si hay datos para esa semana
            $asistencias = Asistencia::where('ID_empleado', $empleado->ID_empleado)
                ->whereBetween('fecha', [$inicioSemana, $finSemana])
                ->get();

            if ($asistencias->isEmpty()) {
                return back()->with('error', 'No hay datos de asistencia para el empleado en la semana seleccionada');
            }

            // Calcular valores para el reporte
            $diasTrabajados = $this->calcularDiasTrabajados($empleado, $inicioSemana, $finSemana);
            $descuentos = $this->calcularDescuentos($empleado, $inicioSemana, $finSemana);
            $pagoTotal = $this->calcularPagoTotal($empleado, $diasTrabajados, $descuentos);

            // Debug: Registrar los valores calculados
            Log::info("Cálculos para empleado {$empleado->ID_empleado}:", [
                'dias_trabajados' => $diasTrabajados,
                'descuentos' => $descuentos,
                'sueldo_diario' => $empleado->sueldo_diario,
                'pago_total' => $pagoTotal
            ]);

            // Crear el reporte individual
            $reporte = ReporteNomina::create([
                'fecha_reporte' => now(),
                'total_empleados' => 1,
                'total_nomina' => $pagoTotal,
                'detalles' => json_encode([[
                    'empleado_id' => $empleado->ID_empleado,
                    'nombre' => $empleado->nombre.' '.$empleado->apellido_paterno.' '.$empleado->apellido_materno,
                    'puesto' => $empleado->puesto->nombre_puesto ?? 'Sin puesto',
                    'sueldo_diario' => $empleado->sueldo_diario,
                    'dias_trabajados' => $diasTrabajados,
                    'dia_descanso' => $empleado->diasDescanso->first()->nombre_dia ?? 'Domingo',
                    'descuentos' => $descuentos,
                    'pago_total' => $pagoTotal,
                    'semana' => $request->semana,
                    'fecha_inicio' => $inicioSemana->format('Y-m-d'),
                    'fecha_fin' => $finSemana->format('Y-m-d')
                ]]),
                'creado_por' => auth()->id()
            ]);

            return redirect()->route('adminn.reportes.ver')
                ->with('success', 'Reporte generado exitosamente para '.$empleado->nombre.' '.$empleado->apellido_paterno);
        });
    }

    private function calcularDiasTrabajados(Empleado $empleado, $inicioPeriodo, $finPeriodo)
    {
        try {
            // Validar fechas
            if (!$inicioPeriodo instanceof Carbon || !$finPeriodo instanceof Carbon) {
                throw new \InvalidArgumentException('Las fechas deben ser instancias de Carbon');
            }

            // Calcular días con asistencia
            $diasConAsistencia = Asistencia::where('ID_empleado', $empleado->ID_empleado)
                ->whereBetween('fecha', [
                    $inicioPeriodo->startOfDay(),
                    $finPeriodo->endOfDay()
                ])
                ->whereNotNull('hora_inicio')
                ->count();

            \Log::info("Cálculo días trabajados - Empleado: {$empleado->ID_empleado}", [
                'periodo' => $inicioPeriodo->format('Y-m-d').' a '.$finPeriodo->format('Y-m-d'),
                'dias_trabajados' => $diasConAsistencia,
                'sueldo_diario' => $empleado->sueldo_diario
            ]);

            return $diasConAsistencia;

        } catch (\Exception $e) {
            \Log::error("Error calculando días trabajados: ".$e->getMessage());
            return 0; // Retornar 0 en caso de error
        }
    }

    private function calcularDescuentos(Empleado $empleado, $inicioPeriodo, $finPeriodo)
    {
        try {
            $descuentosDirectos = Descuento::where('ID_empleado', $empleado->ID_empleado)
                ->whereBetween('fecha', [$inicioPeriodo, $finPeriodo])
                ->sum('monto');

            $descuentosRetrasos = Asistencia::where('ID_empleado', $empleado->ID_empleado)
                ->whereBetween('fecha', [$inicioPeriodo, $finPeriodo])
                ->sum('descuento');

            $totalDescuentos = $descuentosDirectos + $descuentosRetrasos;

            Log::info("Descuentos para {$empleado->ID_empleado}:", [
                'directos' => $descuentosDirectos,
                'retrasos' => $descuentosRetrasos,
                'total' => $totalDescuentos
            ]);

            return $totalDescuentos;
        } catch (\Exception $e) {
            Log::error("Error calculando descuentos para empleado {$empleado->ID_empleado}: " . $e->getMessage());
            return 0;
        }
    }

    private function calcularPagoTotal(Empleado $empleado, $diasTrabajados, $descuentos)
    {
        // Verificar que el sueldo diario sea válido
        if (!is_numeric($empleado->sueldo_diario) || $empleado->sueldo_diario <= 0) {
            Log::error("Sueldo diario inválido para empleado {$empleado->ID_empleado}: {$empleado->sueldo_diario}");
            return 0;
        }

        $pagoBruto = $empleado->sueldo_diario * $diasTrabajados;
        $pagoNeto = max(0, $pagoBruto - $descuentos);

        Log::info("Pago total para {$empleado->ID_empleado}:", [
            'bruto' => $pagoBruto,
            'neto' => $pagoNeto
        ]);

        return $pagoNeto;
    }

    public function ver()
    {
        $reportes = ReporteNomina::orderBy('fecha_reporte', 'desc')
            ->with('creador')
            ->paginate(10);

        return view('adminn.reportes.ver', compact('reportes'));
    }

    public function show($id)
    {
        $reporte = ReporteNomina::findOrFail($id);

        // Asegurarse que los detalles sean un array
        $detalles = is_string($reporte->detalles) ? json_decode($reporte->detalles, true) : $reporte->detalles;

        // Si no es array, convertirlo a array
        if (!is_array($detalles)) {
            $detalles = [$detalles];
        }

        return view('adminn.reportes.detalle', [
            'reporte' => $reporte,
            'detalles' => $detalles
        ]);
    }
    public function exportarPdf($id)
    {
        try {
            $reporte = ReporteNomina::findOrFail($id);

            // Decodificar detalles si es necesario
            $detalles = is_string($reporte->detalles) ? json_decode($reporte->detalles, true) : $reporte->detalles;

            $pdf = Pdf::loadView('adminn.reportes.pdf', [
                'reporte' => $reporte,
                'detalles' => $detalles
            ]);

            return $pdf->download("reporte-nomina-{$id}.pdf");

        } catch (\Exception $e) {
            return redirect()->route('adminn.reportes.ver')
                ->with('error', 'Error al generar PDF: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $reporte = ReporteNomina::findOrFail($id);
            $reporte->delete();

            return redirect()->route('adminn.reportes.ver')
                ->with('success', 'Reporte eliminado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('adminn.reportes.ver')
                ->with('error', 'Error al eliminar reporte: ' . $e->getMessage());
        }
    }
}
