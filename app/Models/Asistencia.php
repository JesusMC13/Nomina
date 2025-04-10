<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia';
    protected $primaryKey = 'ID_asistencia';

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];

    protected $fillable = [
        'ID_empleado',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'minutos_retraso',
        'descuento',
        'justificacion_id'
    ];

    protected $appends = ['hora_entrada_formateada'];

    public function getHoraEntradaFormateadaAttribute()
    {
        return $this->hora_inicio
            ? Carbon::parse($this->hora_inicio)->format('h:i:s A')
            : 'N/A';
    }

    public function calcularRetardo()
    {
        $this->minutos_retraso = 0;
        $this->descuento = 0.00;

        if (!$this->hora_inicio || !$this->empleado || !$this->empleado->turno) {
            return;
        }

        try {
            $horaEsperada = $this->empleado->turno->hora_entrada;
            $tolerancia = $this->empleado->turno->tolerancia_minutos;

            // Obtener solo la parte de hora:minuto:segundo
            $horaEntradaReal = Carbon::parse($this->hora_inicio)->format('H:i:s');
            $horaEsperadaTurno = $this->empleado->turno->hora_entrada;

            // Crear objetos Carbon solo con la hora (sin fecha)
            $entrada = Carbon::createFromTimeString($horaEntradaReal);
            $esperada = Carbon::createFromTimeString($horaEsperadaTurno);

            // Calcular diferencia en minutos
            $diferencia = $entrada->diffInMinutes($esperada, false);

            // Debug: Registrar valores
            \Log::info("Cálculo retardo", [
                'empleado' => $this->empleado->nombre,
                'hora_entrada' => $horaEntradaReal,
                'hora_esperada' => $horaEsperadaTurno,
                'diferencia' => $diferencia,
                'tolerancia' => $tolerancia
            ]);

            // Aplicar tolerancia
            if ($diferencia > $tolerancia) {
                $this->minutos_retraso = $diferencia - $tolerancia;
                $this->calcularDescuento();
            }

        } catch (\Exception $e) {
            \Log::error("Error calculando retardo: " . $e->getMessage());
        }

    }
    public function calcularDescuento()
    {
        if ($this->minutos_retraso <= 0 || !$this->empleado || !$this->empleado->puesto) {
            $this->descuento = 0.00;
            return;
        }

        $salarioDiario = $this->empleado->puesto->salario_base / 30;
        $minutosEfectivos = $this->minutos_retraso;

        if ($minutosEfectivos <= 20) {
            $porcentaje = 0.005; // 0.5%
        } elseif ($minutosEfectivos <= 50) {
            $porcentaje = 0.008; // 0.8%
        } else {
            $porcentaje = 0.012; // 1.2%
        }

        $this->descuento = round($minutosEfectivos * ($porcentaje * $salarioDiario), 2);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
    public function justificacion()
    {
        return $this->hasOne(Justificacion::class);
    }
    public function descuentos()
    {
        return $this->hasMany(Descuento::class, 'ID_asistencia');
    }
}
