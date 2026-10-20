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
        Schema::create('datos_epp_res', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->foreignId('epp_id')->constrained()->onDelete('cascade');
            $table->date('fecha_ingreso');
            $table->string('motivo', 100);
            $table->foreignId('articulo_id')->constrained()->onDelete('cascade');
            $table->date('fecha_entrega');
            $table->string('foto_evidencia', 50);
            $table->string('observaciones', 100);
            $table->integer('talla');
            $table->foreignId('estado_id')->constrained()->onDelete('cascade');
            $table->date('fecha_estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_epp_res');
    }
};
