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
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->foreignId('gerencia_id')->constrained()->onDelete('cascade');
            $table->string('folio', 20);
            $table->string('folio_compras', 20);
            $table->date('fecha_compras');
            $table->date('fecha_solicitud');
            $table->date('fecha_requerido');
            $table->date('fecha_recibido');
            $table->foreignId('proyecto_id')->constrained()->onDelete('cascade');
            $table->foreignId('obra_id')->constrained()->onDelete('cascade');
            $table->foreignId('lugar_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_cotizacion_id')->constrained()->onDelete('cascade');
            $table->string('notas', 100);
            $table->foreignId('estado_pedido_id')->constrained()->onDelete('cascade');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacions');
    }
};
