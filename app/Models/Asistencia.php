<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    // Especificar la tabla y las columnas que se pueden llenar
    protected $table = 'asistencia';

    protected $fillable = [
        'ID_empleado', 'fecha', 'hora_inicio', 'hora_fin'
    ];

    // Definir la relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
}

