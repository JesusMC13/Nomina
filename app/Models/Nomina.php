<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    use HasFactory;

    protected $table = 'nominas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ID_empleado',
        'fecha_inicio',
        'fecha_fin',
        'dias_trabajados',
        'periodo',
        'sueldo_base',
        'horas_extras',
        'bonificaciones',
        'sueldo_bruto',
        'total_descuentos',
        'sueldo_neto',
        'fecha_pago',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_pago' => 'date',
        'sueldo_base' => 'decimal:2',
        'horas_extras' => 'decimal:2',
        'bonificaciones' => 'decimal:2',
        'sueldo_bruto' => 'decimal:2',
        'total_descuentos' => 'decimal:2',
        'sueldo_neto' => 'decimal:2'
    ];

    public function descuentos()
    {
        return $this->hasMany(Descuento::class, 'ID_nomina');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
    // Accesor para el periodo formateado
    public function getPeriodoFormateadoAttribute()
    {
        return $this->fecha_inicio->format('d/m/Y').' - '.$this->fecha_fin->format('d/m/Y');
    }

    // Accesor para el color según estado
    public function getColorEstadoAttribute()
    {
        return [
            'pendiente' => 'warning',
            'pagado' => 'success',
            'cancelado' => 'danger'
        ][$this->estado] ?? 'secondary';
    }
    protected static function booted()
    {
        static::creating(function ($nomina) {
            $nomina->sueldo_bruto = $nomina->sueldo_base + $nomina->horas_extras + $nomina->bonificaciones;
        });

        static::updating(function ($nomina) {
            $nomina->sueldo_bruto = $nomina->sueldo_base + $nomina->horas_extras + $nomina->bonificaciones;
        });
    }
}
