<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'puesto';
    protected $primaryKey = 'id_puesto';
    protected $fillable = ['nombre_puesto', 'salario_base'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id_puesto');
    }

    protected static function booted()
    {
        static::updated(function ($puesto) {
            if ($puesto->isDirty('salario_base')) {
                $puesto->empleados->each(function ($empleado) {
                    $empleado->actualizarSueldosDesdePuesto();
                });
            }
        });
    }
    public function actualizarEmpleados()
    {
        $this->empleados->each->actualizarSueldosDesdePuesto();
    }


}


