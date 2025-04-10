<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSueldoTotalToEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            if (!Schema::hasColumn('empleados', 'sueldo_total')) {
                $table->decimal('sueldo_total', 10, 2)
                    ->nullable()
                    ->after('id_puesto'); // Colocamos después de id_puesto
            }
        });
    }

    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropColumn('sueldo_total');
        });
    }

}
