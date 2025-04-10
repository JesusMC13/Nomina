<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteNomina extends Model
{
    use HasFactory;

    protected $table = 'reporte_nominas';
    protected $primaryKey = 'ID_reporte';

    protected $fillable = [
        'fecha_reporte',
        'total_empleados',
        'total_nomina',
        'detalles',
        'creado_por'
    ];

    protected $casts = [
        'fecha_reporte' => 'date',
        'detalles' => 'array',
        'total_nomina' => 'decimal:2'
    ];

    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }
    // App\Models\ReporteNomina.php
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }

}
