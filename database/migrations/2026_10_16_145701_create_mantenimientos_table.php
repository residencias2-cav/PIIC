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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->foreignId('gerencia_id')->constrained()->onDelete('cascade');
            $table->string('folio', 20);
            $table->string('lugar', 150);
            $table->string('descripcion', 150);
            $table->text('material_necesario');
            $table->foreignId('autorizado_por_id')->constrained()->onDelete('cascade');
            $table->boolean('surtido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
