<?php

namespace App\Models;

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
        return $this->hasMany(ProveedorServicio::class);
    }
}
