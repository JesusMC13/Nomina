<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIDAsistenciaToDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('descuentos', function (Blueprint $table) {
            // Añadir columna ID_asistencia como nullable
            $table->unsignedBigInteger('ID_asistencia')->nullable()->after('fecha');

            // Añadir clave foránea
            $table->foreign('ID_asistencia')
                ->references('ID_asistencia')
                ->on('asistencia')
                ->onDelete('set null');

            // Añadir otras columnas faltantes según tu modelo
            $table->string('origen', 50)->nullable()->comment('retardo, falta, otro');
            $table->text('comentarios')->nullable();
            $table->boolean('aplicado_en_nomina')->default(false);
            $table->boolean('visible_empleado')->default(true);
        });
    }

    public function down()
    {
        Schema::table('descuentos', function (Blueprint $table) {
            // Eliminar la clave foránea primero
            $table->dropForeign(['ID_asistencia']);

            // Eliminar las columnas añadidas
            $table->dropColumn([
                'ID_asistencia',
                'origen',
                'comentarios',
                'aplicado_en_nomina',
                'visible_empleado'
            ]);
        });
    }
}
