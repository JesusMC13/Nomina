<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('dias_descanso', function (Blueprint $table) {
            $table->id('ID_dia_descanso');
            $table->string('nombre_dia', 20)->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('dias_descanso');
    }
};
