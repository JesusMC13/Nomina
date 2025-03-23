<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaDescanso extends Model
{
    protected $table = 'Dias_descanso';
    protected $primaryKey = 'ID_dia_descanso';
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Dia'
    ];
}
