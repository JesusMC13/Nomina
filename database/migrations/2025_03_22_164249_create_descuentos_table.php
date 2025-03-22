<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id('ID_descuento');
            $table->unsignedBigInteger('ID_empleado');
            $table->foreign('ID_empleado')->references('ID_empleado')->on('empleados')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->string('tipo_descuento', 100);
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('descuentos');
    }
};
