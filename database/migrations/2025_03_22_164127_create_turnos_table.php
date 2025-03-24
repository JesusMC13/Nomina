<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_empleado');
            $table->string('turno');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();

            $table->foreign('ID_empleado')->references('ID_empleado')->on('empleados')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('turnos');
    }
};

