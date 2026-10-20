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
        Schema::create('oficios_rutas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oficio_id')->constrained()->onDelete('cascade');
            $table->string('folio_ac', 20);
            $table->string('ruta', 100);
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['aviso ordinario', 'aviso de requisicion', 'solicitud de anticipo']);
            $table->string('carta_porte', 50);
            $table->boolean('factura');
            $table->integer('no_recoleccion');
            $table->string('observaciones', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficios_rutas');
    }
};
