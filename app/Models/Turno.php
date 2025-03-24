<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model {
    use HasFactory;

    protected $table = 'turnos';

    protected $fillable = [
        'ID_empleado',
        'turno',
        'fecha_inicio',
        'fecha_fin'
    ];

    public function empleado() {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
}
