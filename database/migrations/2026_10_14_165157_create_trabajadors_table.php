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
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id();
            $table->string('nt', 15);
            $table->string('nombre', 50);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->enum('sexo', ['Hombre', 'Mujer']);
            $table->string('nss', 20)->unique();
            $table->string('curp', 18)->unique();
            $table->string('rfc', 13)->unique();
            $table->date('fecha_nacimiento');
            $table->foreignId('lugar_nacimiento_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_sangre_id')->constrained()->onDelete('cascade');
            $table->softDeletes('deleted_at', $precision = null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajador');
    }
};
