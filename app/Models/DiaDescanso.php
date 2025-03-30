<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDescanso extends Model
{
    use HasFactory;

    protected $table = 'dias_descanso'; // Tabla en la base de datos
    protected $primaryKey = 'ID_dia_descanso'; // Establecer la clave primaria correcta
    public $timestamps = true; // Si usas created_at y updated_at

    protected $fillable = ['nombre_dia']; // Los campos que se pueden asignar masivamente
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_dias_descanso', 'dia_descanso_id', 'empleado_id');
    }

}
