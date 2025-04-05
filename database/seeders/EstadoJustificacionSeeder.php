<?php

namespace Database\Seeders;

use App\Models\EstadoJustificacion;
use Illuminate\Database\Seeder;

class EstadoJustificacionSeeder extends Seeder
{
    public function run()
    {
        $estados = [
            ['nombre_estado' => 'Pendiente'],
            ['nombre_estado' => 'Aprobado'],
            ['nombre_estado' => 'Rechazado']
        ];

        foreach ($estados as $estado) {
            EstadoJustificacion::firstOrCreate($estado);
        }
    }
}
