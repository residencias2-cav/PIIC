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
        Schema::create('datos_proveedors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->string('folio', 11);
            $table->date('fecha');
            $table->string('observaciones', 100);
            $table->string('tiempo_entrega', 50);
            $table->string('metodo_entrega', 50);
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->string('correo', 50);
            $table->string('telefono', 20);
            $table->text('direccion');
            $table->string('tipo_contrato', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_proveedors');
    }
};
