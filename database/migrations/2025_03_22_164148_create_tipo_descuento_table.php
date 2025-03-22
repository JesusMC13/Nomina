<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tipo_descuento', function (Blueprint $table) {
            $table->id('ID_tipo_descuento');
            $table->string('nombre_descuento', 50)->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tipo_descuento');
    }
};
