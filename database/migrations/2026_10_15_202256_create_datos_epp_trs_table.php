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
        Schema::create('datos_epp_trs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('epp_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad');
            $table->text('descripcion');
            $table->string('codigo', 50);
            $table->string('marca', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_epp_trs');
    }
};
