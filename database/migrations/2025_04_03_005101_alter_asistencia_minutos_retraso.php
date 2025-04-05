<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAsistenciaMinutosRetraso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // database/migrations/xxxx_alter_asistencia_minutos_retraso.php
    public function up()
    {
        DB::statement('ALTER TABLE asistencia MODIFY minutos_retraso INT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE asistencia MODIFY minutos_retraso SMALLINT');
    }
}
