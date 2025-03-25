<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VistaAsistenciaEmpleado extends Model
{
    protected $table = 'vista_asistencias_empleados';  // Nombre de la vista
    public $timestamps = false;  // No es necesario usar los timestamps en la vista

    // Definir los campos que se pueden llenar (si los necesitas)
    protected $fillable = [
        'ID_empleado', 'nombre_completo', 'fecha', 'hora_inicio', 'hora_fin'
    ];
}
