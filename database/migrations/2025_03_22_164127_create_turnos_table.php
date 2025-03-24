<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id('ID_turno'); // Clave primaria
            $table->string('nombre_turno'); // Nombre del turno
            $table->time('hora_entrada'); // Hora de entrada
            $table->time('hora_salida'); // Hora de salida
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down() {
        Schema::dropIfExists('turnos');
    }
};
