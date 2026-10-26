<?php

namespace App\Models\Catalogos;

use App\Models\Proveedores\Proveedor;
use App\Models\Proveedores\ProveedorServicio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductoServicio extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoServicioFactory> */
    use HasFactory;

    protected $table = 'producto_servicios';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function productosServicios()
    {
        return $this->belongsToMany(Proveedor::class, 'producto_servicio_id', 'proveedor_id');
    }
}
