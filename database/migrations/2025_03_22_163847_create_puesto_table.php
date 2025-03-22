<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('puesto', function (Blueprint $table) {
            $table->id('id_puesto');
            $table->string('nombre_puesto', 50)->unique();
            $table->decimal('salario_base', 10, 2)->check('salario_base > 0');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('puesto');
    }
};
