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
        Schema::create('datos_epp_nis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('epp_id')->constrained()->onDelete('cascade');
            $table->foreignId('trabajador_id')->constrained()->onDelete('cascade');
            $table->foreignId('articulo_id')->constrained()->onDelete('cascade');
            $table->enum('sup_int', ['superficie', 'interior_mina']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_epp_nis');
    }
};
