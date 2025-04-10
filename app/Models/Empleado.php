<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'ID_empleado';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_puesto',
        'turno_id',
        'user_id',
        'puesto_id',
        'hora_entrada',
        'sueldo_diario',
        'sueldo_total'
    ];

    protected $appends = ['nombre_completo'];

    protected static function booted()
    {
        static::creating(function ($empleado) {
            $empleado->calcularSueldos(); // Se ejecuta al crear
        });

        static::updating(function ($empleado) {
            if ($empleado->isDirty('id_puesto')) {
                $empleado->calcularSueldos(); // Se ejecuta al cambiar puesto
            }
        });
    }

    public function calcularSueldos()
    {
        if ($this->puesto) {
            $this->sueldo_total = $this->puesto->salario_base * 4; // Mensual (4 semanas)
            $this->sueldo_diario = $this->puesto->salario_base / 6; // 6 días laborales por semana
        }
    }


    public function actualizarSueldosDesdePuesto()
    {
        $this->calcularSueldos();
        $this->save();
    }

    // Relaciones
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id', 'ID_turno');
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'asigna_turnos', 'ID_empleado', 'ID_turno')
            ->withTimestamps();
    }

    public function diasDescanso()
    {
        return $this->belongsToMany(DiaDescanso::class, 'empleado_dias_descanso', 'empleado_id', 'dia_descanso_id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'ID_empleado');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function nominas() {
        return $this->hasMany(Nomina::class, 'ID_empleado');
    }
    // Accessors
    public function getNombreCompletoAttribute()
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }

    public function getHoraEntradaEsperadaAttribute()
    {
        if ($this->hora_entrada) {
            return Carbon::parse($this->hora_entrada);
        }

        if ($this->turno) {
            return Carbon::parse($this->turno->hora_entrada);
        }

        return Carbon::parse('09:00:00');
    }

    // Métodos adicionales
    public function calcularProximoDescanso()
    {
        if (!$this->diasDescanso || $this->diasDescanso->isEmpty()) {
            return null;
        }

        $hoy = now();
        $diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $diaActual = $hoy->dayOfWeek;

        $diasDescanso = $this->diasDescanso->pluck('nombre_dia')->map(function($dia) use ($diasSemana) {
            return array_search($dia, $diasSemana);
        })->sort()->values();

        foreach ($diasDescanso as $diaNum) {
            if ($diaNum > $diaActual) {
                return [
                    'dia' => $diasSemana[$diaNum],
                    'fecha' => $hoy->next($diaNum)
                ];
            }
        }

        $primerDiaDescanso = $diasDescanso->first();
        return [
            'dia' => $diasSemana[$primerDiaDescanso],
            'fecha' => $hoy->next($primerDiaDescanso)
        ];
    }
}
