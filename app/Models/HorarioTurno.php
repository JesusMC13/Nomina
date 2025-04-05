<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioTurno extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    public $timestamps = false;

    protected $fillable = [
        'ID_empleado',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'puesto_id',
        'turno_id',
        'hora_entrada',
        'sueldo_diario',
        'sueldo_total'
    ];

    // Relación con el puesto
    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id', 'id_puesto');
    }

    // Relación con el turno
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id', 'ID_turno');
    }

    // Accesor para el nombre completo
    public function getEmpleadoCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }
}
