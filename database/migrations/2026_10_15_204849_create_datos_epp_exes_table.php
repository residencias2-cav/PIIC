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
        Schema::create('datos_epp_exes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('epp_id')->constrained()->onDelete('cascade');
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('equipo', 50);
            $table->string('codigo', 50);
            $table->string('marca', 50);
            $table->boolean('contrato');
            $table->string('observaciones', 100);
            $table->decimal('precio', 10, 2);
            $table->string('adjuntos', 50);
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
        Schema::dropIfExists('datos_epp_exes');
    }
};
