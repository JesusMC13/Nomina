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
        'ID_estado'
    ];
    protected $dates = ['fecha'];
    public $timestamps = true;

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoJustificacion::class, 'ID_estado');
    }
}
