<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignarTurno extends Model
{
    use HasFactory;

    protected $table = 'asigna_turnos'; // <- Este es el nombre correcto según tu BD
    protected $primaryKey = 'ID_asigna_t'; // <- Confirma que esta es la clave primaria

    public $timestamps = true;

    protected $fillable = [
        'ID_empleado',
        'ID_turno',
        'created_at',
        'updated_at',
    ];

    // Relación con empleados
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }

    // Relación con turnos
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'ID_turno');
    }
}
