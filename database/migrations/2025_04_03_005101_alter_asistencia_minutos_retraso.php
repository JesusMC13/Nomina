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
        Schema::table('asistencia', function (Blueprint $table) {
            $table->integer('minutos_retraso')->change(); // Cambia a INTEGER que soporta hasta 2,147,483,647
        });
    }

    public function down()
    {
        Schema::table('asistencia', function (Blueprint $table) {
            $table->smallInteger('minutos_retraso')->change(); // Revertir si es necesario
        });
    }
}
