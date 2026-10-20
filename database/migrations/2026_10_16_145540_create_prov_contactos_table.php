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
        Schema::create('prov_contactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacion_id')->constrained()->onDelete('cascade');
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prov_contactos');
    }
};
