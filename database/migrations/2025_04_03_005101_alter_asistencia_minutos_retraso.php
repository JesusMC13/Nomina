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
        // Verificar que la columna existe antes de modificarla
        if (Schema::hasColumn('asistencia', 'minutos_retraso')) {
            Schema::table('asistencia', function (Blueprint $table) {
                $table->integer('minutos_retraso')->nullable()->change();
            });
        }
    }

    public function down()
    {
        // No es necesario revertir en este caso
    }
}
