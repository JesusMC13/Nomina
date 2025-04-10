<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNominasTableAddColumns extends Migration
{
    public function up()
    {
        Schema::table('nominas', function (Blueprint $table) {
            // Añade las columnas faltantes
            if (!Schema::hasColumn('nominas', 'dias_trabajados')) {
                $table->integer('dias_trabajados')->after('fecha_fin');
            }

            if (!Schema::hasColumn('nominas', 'sueldo_base')) {
                $table->decimal('sueldo_base', 10, 2)->after('dias_trabajados');
            }

            if (!Schema::hasColumn('nominas', 'total_descuentos')) {
                $table->decimal('total_descuentos', 10, 2)->after('sueldo_base');
            }

            if (!Schema::hasColumn('nominas', 'sueldo_neto')) {
                $table->decimal('sueldo_neto', 10, 2)->after('total_descuentos');
            }

            if (!Schema::hasColumn('nominas', 'periodo')) {
                $table->string('periodo', 20)->after('estado');
            }
        });
    }

    public function down()
    {
        Schema::table('nominas', function (Blueprint $table) {
            // Opcional: Eliminar las columnas si necesitas revertir
            $table->dropColumn([
                'dias_trabajados',
                'sueldo_base',
                'total_descuentos',
                'sueldo_neto',
                'periodo'
            ]);
        });
    }
}
