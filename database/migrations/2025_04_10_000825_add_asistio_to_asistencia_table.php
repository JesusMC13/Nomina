<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsistioToAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistencia', function (Blueprint $table) {
            $table->boolean('asistio')->default(true)->after('minutos_retraso');
        });
    }

    public function down()
    {
        Schema::table('asistencia', function (Blueprint $table) {
            $table->dropColumn('asistio');
        });

    }
}
