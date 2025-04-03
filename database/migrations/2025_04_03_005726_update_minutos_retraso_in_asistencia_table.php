<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateMinutosRetrasoInAsistenciaTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        // Corrige los valores existentes que excedan 1440 minutos (24 horas)
        DB::statement('UPDATE asistencia SET minutos_retraso = LEAST(minutos_retraso, 1440) WHERE minutos_retraso > 1440');
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        // No es necesario revertir esta operación
        // (No podemos recuperar los valores originales que excedían 1440)
    }
}
