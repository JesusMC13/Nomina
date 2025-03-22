<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('estado_justificacion', function (Blueprint $table) {
            $table->id('ID_estado');
            $table->string('nombre_estado', 50)->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('estado_justificacion');
    }
};
