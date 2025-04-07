<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
protected $table = 'justificaciones';
protected $primaryKey = 'ID_justificacion';
protected $fillable = [
'ID_empleado',
'fecha',
'motivo',
'ID_estado',
'archivo', // Añadido para soportar archivos adjuntos
'comentario_admin' // Añadido para los comentarios del administrador
];
protected $dates = ['fecha'];
public $timestamps = true;

public function empleado()
{
return $this->belongsTo(Empleado::class, 'ID_empleado');
}

// En app/Models/Justificacion.php
    public function estado()
    {
        return $this->belongsTo(EstadoJustificacion::class, 'ID_estado');
    }

// Método para verificar si está pendiente
public function estaPendiente()
{
return $this->estado->nombre == 'pendiente';
}

// Método para verificar si está aprobada
public function estaAprobada()
{
return $this->estado->nombre == 'aprobado';
}

// Método para verificar si está rechazada
public function estaRechazada()
{
return $this->estado->nombre == 'rechazado';
}
}
