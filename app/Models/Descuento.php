<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $table = 'descuentos';
    protected $primaryKey = 'ID_descuento';

    protected $fillable = [
        'ID_empleado',
        'monto',
        'tipo_descuento',
        'fecha',
        'origen',
        'ID_asistencia',
        'comentarios',
        'aplicado_en_nomina',
        'visible_empleado'
    ];

    protected $casts = [
        'fecha' => 'date',
        'aplicado_en_nomina' => 'boolean',
        'visible_empleado' => 'boolean'
    ];

    // Tipos de descuentos permitidos
    const TIPOS = [
        'retardo' => 'Retardo',
        'falta' => 'Falta',
        'otro' => 'Otro'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'ID_asistencia');
    }

    // Scope para descuentos visibles al empleado
    public function scopeVisible($query)
    {
        return $query->where('visible_empleado', true);
    }

    public function nomina()
    {
        return $this->belongsTo(Nomina::class, 'ID_nomina');
    }

}

