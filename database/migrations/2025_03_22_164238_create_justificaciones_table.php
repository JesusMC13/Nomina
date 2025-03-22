<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('justificaciones', function (Blueprint $table) {
            $table->id('ID_justificacion');
            $table->unsignedBigInteger('ID_empleado');
            $table->foreign('ID_empleado')->references('ID_empleado')->on('empleados')->onDelete('cascade');
            $table->date('fecha');
            $table->text('motivo');
            $table->unsignedBigInteger('ID_estado');
            $table->foreign('ID_estado')->references('ID_estado')->on('estado_justificacion')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('justificaciones');
    }
};

