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
        Schema::create('usuarios_proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 80);
            $table->string('contraseña', 20);
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_usuario_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_proveedores');
    }
};
