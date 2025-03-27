<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();  // Añadir la columna user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Relaciona user_id con id de la tabla users
        });
    }
    
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign(['user_id']);  // Eliminar la clave foránea
            $table->dropColumn('user_id');  // Eliminar la columna user_id
        });
    }
    
}
