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
        Schema::create('informacion_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_banco', 50);
            $table->string('nombre_titular', 100);
            $table->string('cuenta', 11);
            $table->string('clave', 18);
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_bancarias');
    }
};
