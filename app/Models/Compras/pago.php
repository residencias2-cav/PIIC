<?php

namespace App\Models\Compras;

use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    /** @use HasFactory<\Database\Factories\PagoFactory> */
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'proveedor_id',
        'precio',
        'iva',
        'total',
        'descuento',
        'factura',
        'comision',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'iva' => 'decimal:2',
            'total' => 'decimal:2',
            'descuento' => 'decimal:2',
            'factura' => 'decimal:2',
            'comision' => 'decimal:2',
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}