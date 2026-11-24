<?php

namespace App\Models\Proveedores;

use App\Models\Catalogos\ProductoServicio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorServicio extends Model
{
    use HasFactory;

    protected $table = 'proveedor_servicios';

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = [
        'proveedor_id',
        'producto_servicio_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function productoServicio()
    {
        return $this->belongsTo(
            ProductoServicio::class,
            'producto_servicio_id'
        );
    }
}
