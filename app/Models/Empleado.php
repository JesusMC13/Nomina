<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    // Especifica la clave primaria si no es 'id'
    protected $primaryKey = 'ID_empleado';  // Ajusta al nombre real de la columna

    // Si tu clave primaria no es auto incremental, agrega esto:
    public $incrementing = false;

    // Si tu clave primaria es de un tipo diferente (como string o UUID)
    protected $keyType = 'string';  // Asegúrate de que coincida con el tipo de dato de la clave primaria

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_puesto',
    ];
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
        return $this->belongsTo(Puesto::class, 'id_puesto'); // Relación con la tabla de puestos
    }

    public function turno()
    {
        return $this->belongsTo(AsignarTurno::class, 'ID_empleado'); // Relación con la tabla asigna_turnos
    }
    
    

}

