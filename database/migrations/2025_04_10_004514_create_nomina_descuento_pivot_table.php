<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaDescuentoPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_descuento', function (Blueprint $table) {
            $table->unsignedBigInteger('nomina_id');
            $table->unsignedBigInteger('descuento_id');
            $table->decimal('monto_aplicado', 10, 2);

            $table->foreign('nomina_id')->references('id')->on('nominas')->onDelete('cascade');
            $table->foreign('descuento_id')->references('ID_descuento')->on('descuentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomina_descuento_pivot');
    }
}
