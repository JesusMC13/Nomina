<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'puesto'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_puesto'; // Definir la clave primaria

    protected $fillable = ['nombre_puesto', 'salario_base']; // Columnas que pueden ser asignadas en masa

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id_puesto');
    }
}
    

