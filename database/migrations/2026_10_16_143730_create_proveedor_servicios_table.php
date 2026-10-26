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
        Schema::create('proveedor_servicios', function (Blueprint $table) {
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_servicio_id')->constrained()->onDelete('cascade');
            $table->primary(['proveedor_id', 'producto_servicio_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor_servicios');
    }
};
