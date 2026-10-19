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
        Schema::create('epp', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('folio', 20);
            $table->foreignId('tipo_epp_id')->constrained()->onDelete('cascade');
            $table->foreignId('obra_id')->constrained()->onDelete('cascade');       
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->string('motivo', 150);
            $table->string('justificacion', 100);
            $table->string('logistica', 100);
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epp');
    }
};
