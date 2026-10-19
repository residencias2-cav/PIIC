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
        Schema::create('oficios_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oficios_id')->constrained()->onDelete('cascade');
            $table->date('fecha_firma');
            $table->string('nombre_producto', 50);
            $table->decimal('monto_total', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->string('folio_factura', 20);
            $table->string('factura', 50);
            $table->decimal('monto', 10, 2);
            $table->decimal('porcentaje', 10, 2);
            $table->string('notificacion', 50);
            $table->decimal('descuento', 10, 2);
            $table->decimal('saldo_pendiente', 10, 2);
            $table->foreignId('proveedor_id')->constrained()->onDelete('cascade');
            $table->foreignId('contrato_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficios_productos');
    }
};
