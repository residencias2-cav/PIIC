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
        Schema::create('autorizacions', function (Blueprint $table) {
            $table->id();
            $table->foreign('usuarios_id')->constrained()->onDelete('cascade');
            $table->foreign('pedido_id')->constrained()->onDelete('cascade');
            $table->boolean('proceso_autorizado');
            $table->string('feche_autorizacion', 100);
            $table->string('observaciones', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizacions');
    }
};
