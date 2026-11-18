<?php
namespace App\Models\Oficios;

use App\Models\Catalogos\Contrato;
use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OficiosProductos extends Model
{
    use HasFactory;

    protected $table = 'oficios_productos';

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
        'notificacion',
        'descuento',
        'saldo_pendiente',
        'proveedor_id',
        'contrato_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha_firma' => 'datetime',
            'monto_total' => 'decimal:2',
            'iva' => 'decimal:2',
            'monto' => 'decimal:2',
            'porcentaje' => 'decimal:2',
            'descuento' => 'decimal:2',
            'saldo_pendiente' => 'decimal:2',
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function oficio()
    {
        return $this->belongsTo(Oficios::class, 'oficios_id');
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