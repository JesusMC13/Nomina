<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

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
        'sueldo_diario' // Nueva columna
    ];
    public function getHoraEntradaEsperadaAttribute()
    {
        // 1. Prioridad a hora personalizada del empleado
        if ($this->hora_entrada) {
            return Carbon::parse($this->hora_entrada);
        }

        // 2. Usar horario del turno asignado
        if ($this->turno) {
            return Carbon::parse($this->turno->hora_entrada);
        }

        // 3. Valor por defecto
        return Carbon::parse('09:00:00');
    }
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id', 'ID_turno');
    }

    /**
     * O si es una relación muchos-a-muchos (usando tabla pivote):
     */
    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'asigna_turnos', 'ID_empleado', 'ID_turno')
            ->withTimestamps();
    }

    public function diasDescanso()
    {
        return $this->belongsToMany(DiaDescanso::class, 'empleado_dias_descanso', 'dia_descanso_id', 'empleado_id');
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'ID_empleado');
    }
    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto', 'id_puesto');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Agrega este método para nombre completo
    public function getNombreCompletoAttribute()
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }

// Y añade el accessor a los appends
    protected $appends = ['nombre_completo'];



}

