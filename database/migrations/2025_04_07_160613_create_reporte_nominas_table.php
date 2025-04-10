<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reporte_nominas', function (Blueprint $table) {
            $table->id('ID_reporte');
            $table->date('fecha_reporte');
            $table->integer('total_empleados');
            $table->decimal('total_nomina', 12, 2);
            $table->json('detalles');
            $table->foreignId('creado_por')->constrained('users');
            $table->timestamps();

            // Índices para mejor performance
            $table->index('fecha_reporte');
            $table->index('creado_por');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reporte_nominas');
    }
};
