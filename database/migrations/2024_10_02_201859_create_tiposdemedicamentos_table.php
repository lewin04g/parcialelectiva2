<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //correr la migra
    public function up(): void
    {
        Schema::create('tipos_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo'); 
            $table->timestamps();
        });
    }

    //devolver la migra
    public function down(): void
    {
        Schema::dropIfExists('tipos_medicamentos');
    }
};
