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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->foreignId('gerencia_id')->constrained()->onDelete('cascade');
            $table->string('usuario', 20);
            $table->foreignId('tipo_usuario_id')->constrained()->onDelete('cascade');
            $table->boolean('tipos_usuario_ch');
            $table->string('contraseña_correo', 20);
            $table->string('twofa_code', 32);
            $table->datetime('twofa_expire');
            $table->integer('twofa_attempts', 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
