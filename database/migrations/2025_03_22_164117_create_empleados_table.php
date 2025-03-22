<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('ID_empleado');
            $table->string('nombre', 50);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->foreignId('id_puesto')->constrained('puesto', 'id_puesto')->onDelete('cascade');
            $table->unique(['nombre', 'apellido_paterno', 'apellido_materno']);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('empleados');
    }
};
