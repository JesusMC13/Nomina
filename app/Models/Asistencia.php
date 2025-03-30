<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia';
    protected $primaryKey = 'ID_asistencia';
    public $timestamps = true;

    protected $fillable = [
        'ID_empleado',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
}
