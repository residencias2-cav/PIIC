<?php

namespace App\Models\Oficios;

use App\Models\Catalogos\Contrato;
use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OficiosProductos extends Model
{
    /** @use HasFactory<\Database\Factories\OficiosProductosFactory> */
    use HasFactory;

    protected $table = 'oficiosproductos';

    protected $fillable = [
        'oficios_id',
        'fecha_firma',
        'nombre_producto',
        'monto_total',
        'iva',
        'folio_factura',
        'factura',
        'monto',
        'porcentaje',
        'modificacion',
        'descuento',
        'saldo_pendiente',
        'proveedor_id',
        'contrato_id'
    ];

    protected function casts(): array
    {
        return [
            'fecha_firma' => 'datetime',
            'monto_total' => 'decimal',
            'iva' => 'decimal',
            'monto'=> 'decimal',
            'porcentaje' => 'decimal',
            'descuento' => 'decimal',
            'saldo_pendiente' => 'decimal',
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function oficios()
    {
        return $this->belongsTo(Oficios::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
