<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoJustificacion extends Model
{
    protected $table = 'estado_justificacion';
    protected $primaryKey = 'ID_estado';
    protected $fillable = ['nombre_estado'];
    public $timestamps = true;

    public function justificaciones()
    {
        return $this->hasMany(Justificacion::class, 'ID_estado');
    }
}
