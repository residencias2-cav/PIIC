<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto_Servicio extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoServicioFactory> */
    use HasFactory;

    protected $table = 'producto_servicio';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function productos_servicios()
    {
        return $this->hasMany(Proveedor_Servicio::class);
    }
}
