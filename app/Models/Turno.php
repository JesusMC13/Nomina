<?php
// app/Models/Turno.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turnos'; // Asegúrate de que el nombre de la tabla sea correcto
    protected $primaryKey = 'ID_turno'; // Si la clave primaria no es 'id', asegúrate de definirla
    public $timestamps = true; // Si estás usando created_at y updated_at, deja esto en true

    protected $fillable = [
        'nombre_turno',
        'hora_entrada',
        'hora_salida',
    ];
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'asigna_turnos', 'ID_turno', 'ID_empleado');
    }
    

}

