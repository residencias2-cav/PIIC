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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('razon_social', 100);
            $table->string('curp', 18)->unique();
            $table->string('rfc', 13)->unique();
            $table->string('area', 30);
            $table->string('desc_bs', 100);
            $table->date('vigencia_sat');
            $table->foreignId('inf_credito_id')->constrained()->onDelete('cascade');
            $table->foreignId('inf_contrato_id')->constrained()->onDelete('cascade');
            $table->text('inf_impuestos');
            $table->boolean('registrado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
