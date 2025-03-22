<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('periodo', function (Blueprint $table) {
            $table->id('ID_periodo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->check('fecha_fin > fecha_inicio');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('periodo');
    }
};
