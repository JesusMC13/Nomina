<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('empleado_dias_descanso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('dia_descanso_id');
            $table->foreign('empleado_id')->references('ID_empleado')->on('empleados')->onDelete('cascade');
            $table->foreign('dia_descanso_id')->references('ID_dia_descanso')->on('dias_descanso')->onDelete('cascade');
            $table->timestamps(); // Añade las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleado_dias_descanso');
    }
};
