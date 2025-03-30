<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoDiaDescanso extends Model
{
    use HasFactory;

    protected $table = 'empleado_dias_descanso'; // Nombre de la tabla

    protected $fillable = [
        'empleado_id',
        'dia_descanso_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'ID_empleado');
    }

    public function diaDescanso()
    {
        return $this->belongsTo(DiaDescanso::class, 'dia_descanso_id', 'ID_dia_descanso');
    }
}
