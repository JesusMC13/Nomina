<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIDNominaToDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descuentos', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_nomina')->nullable()->after('ID_asistencia');
            $table->foreign('ID_nomina')->references('id')->on('nominas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('descuentos', function (Blueprint $table) {
            $table->dropForeign(['ID_nomina']);
            $table->dropColumn('ID_nomina');
        });
    }
}
