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
        'fecha'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_empleado');
    }
}
