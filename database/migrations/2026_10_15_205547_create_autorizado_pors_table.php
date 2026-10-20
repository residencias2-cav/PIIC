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
        Schema::create('autorizado_pors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->foreignId('epp_id')->constrained()->onDelete('cascade');
            $table->boolean('proceso_autorizado');
            $table->date('fecha_autorizacion');
            $table->string('observaciones', 100);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizado_pors');
    }
};
