<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $tabla) {
            $tabla->id();

            $tabla->string('nombre_medicamento');
            $tabla->foreignId('id_tipo_medi')
                ->constrained('tipos_medicamentos')
                ->onDelete('cascade');

            $tabla->integer('cantidad');

            $tabla->foreignId('id_distri')
                ->constrained('distribuidores')
                ->onDelete('cascade');

            $tabla->foreignId('id_sucur')
                ->constrained('sucursales')
                ->onDelete('cascade');

            $tabla->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
