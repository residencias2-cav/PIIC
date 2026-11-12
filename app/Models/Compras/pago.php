<?php

namespace App\Models\Compras;

use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

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
        'comision'
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal',
            'iva' => 'decimal',
            'total' => 'decimal',
            'descuento' => 'decimal',
            'factura' => 'decimal',
            'comision' => 'decimal',
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
