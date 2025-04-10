<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSueldoBrutoFromNominasTable extends Migration
{
    public function up()
    {
        Schema::table('nominas', function (Blueprint $table) {
            $table->dropColumn('sueldo_bruto');
        });
    }

    public function down()
    {
        Schema::table('nominas', function (Blueprint $table) {
            $table->decimal('sueldo_bruto', 10, 2)->default(0);
        });
    }
}
