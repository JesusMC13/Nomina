<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id('ID_turno');
            $table->string('nombre_turno', 50)->unique();
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('turnos');
    }
};
