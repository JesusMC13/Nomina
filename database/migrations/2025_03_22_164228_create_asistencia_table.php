<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id('ID_asistencia');

            // Verifica que el nombre de la clave primaria de empleados sea correcto
            $table->unsignedBigInteger('ID_empleado');
            $table->foreign('ID_empleado')->references('ID_empleado')->on('empleados')->onDelete('cascade');

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->unique(['ID_empleado', 'fecha']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencia');
    }
};
