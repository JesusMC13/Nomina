<?php
// app/Models/TipoDescuento.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDescuento extends Model
{
use HasFactory;

protected $table = 'tipo_descuento';
protected $fillable = ['nombre', 'descripcion', 'porcentaje', 'estado'];
}
