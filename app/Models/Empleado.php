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
    ];

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
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
    
    

}

