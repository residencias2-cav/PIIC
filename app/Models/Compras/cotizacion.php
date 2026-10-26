<?php

namespace App\Models\Compras;

use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    /** @use HasFactory<\Database\Factories\CotizacionFactory> */
    use HasFactory;

    public function provContacto()
    {
        return $this->belongsToMany(Proveedor::class, 'prov_contactos', 'cotizacion_id', 'proveedor_id')->withTimestamps();
    }
}
