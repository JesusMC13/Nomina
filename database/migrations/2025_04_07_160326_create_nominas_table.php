<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominasTable extends Migration
{
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->id('ID_nomina');
            $table->foreignId('ID_empleado')->constrained('empleados', 'ID_empleado');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('dias_trabajados');
            $table->decimal('sueldo_base', 10, 2);
            $table->decimal('horas_extras', 10, 2)->default(0);
            $table->decimal('bonificaciones', 10, 2)->default(0);
            $table->decimal('total_descuentos', 10, 2);
            $table->decimal('sueldo_neto', 10, 2);
            $table->date('fecha_pago');
            $table->enum('estado', ['pendiente', 'pagado', 'cancelado'])->default('pendiente');
            $table->string('periodo', 20); // semanal, quincenal, mensual
            $table->text('comentarios')->nullable();
            $table->timestamps();

            $table->index('ID_empleado');
            $table->index('fecha_inicio');
            $table->index('fecha_fin');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nominas');
    }
}
