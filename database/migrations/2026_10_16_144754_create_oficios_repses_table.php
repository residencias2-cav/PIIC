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
        Schema::create('oficios_repses', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_firma');
            $table->foreignId('contrato_id')->constrained()->onDelete('cascade');
            $table->foreignId('oficio_id')->constrained()->onDelete('cascade');
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('identificacion_contrato', 50);
            $table->string('ob_social_cct', 50);
            $table->string('ob_social_cts', 50);
            $table->string('repse', 50);
            $table->string('folio_actividad', 20);
            $table->string('actividad', 50);
            $table->string('vigencia', 20);
            $table->string('servicio_prestado', 50);
            $table->decimal('precio', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('pago_servicio', 10, 2);
            $table->string('correo_contacto', 50);
            $table->string('terminacion', 50);
            $table->string('contacto_contratante', 50);
            $table->string('testigo', 50);
            $table->string('productos', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficios_repses');
    }
};