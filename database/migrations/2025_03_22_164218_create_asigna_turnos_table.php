<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('asigna_turnos', function (Blueprint $table) {
            $table->id('ID_asigna_t');

            // Clave foránea para empleados
            $table->unsignedBigInteger('ID_empleado');
            $table->foreign('ID_empleado')->references('ID_empleado')->on('empleados')->onDelete('cascade');

            // Clave foránea para turnos
            $table->unsignedBigInteger('ID_turno');
            $table->foreign('ID_turno')->references('ID_turno')->on('turnos')->onDelete('cascade');

            // Restricción única para evitar asignaciones duplicadas
            $table->unique(['ID_empleado', 'ID_turno']);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('asigna_turnos');
    }
};
