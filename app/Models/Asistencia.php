<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención de Laravel)
    protected $table = 'asistencia';

    // Clave primaria personalizada
    protected $primaryKey = 'ID_asistencia';

    // Campos asignables masivamente
    protected $fillable = [
        'ID_empleado',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    // Campos de fecha (opcional si usas timestamps)
    protected $dates = [
        'fecha',
        'created_at',
        'updated_at',
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
}
