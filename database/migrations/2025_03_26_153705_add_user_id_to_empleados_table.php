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
        if (!Schema::hasColumn('empleados', 'user_id')) {
            Schema::table('empleados', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            });
        }
    }

    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }

}
