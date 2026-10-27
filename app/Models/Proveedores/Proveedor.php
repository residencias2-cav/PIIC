<?php

namespace App\Models\Proveedores;

use App\Models\Catalogos\{
    InfContrato,
    InfCredito,
    ProductoServicio
    };
use App\Models\Compras\{
    Cotizacion,
    Pago
    };
use App\Models\Oficios\{
    OficiosProductos,
    OficiosRepse
    };
use App\Models\Usuarios\UsuariosProveedores;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedorFactory> */
    use HasFactory;

    protected $table = 'proveedors';

    protected $fillable = [
        'nombre',
        'razon_social',
        'curp',
        'rfc',
        'area',
        'desc_bs',
        'vigencia_sat',
        'inf_credito_id',
        'inf_contrato_id',
        'inf_impuestos',
        'registrado',
    ];

    protected function casts(): array
    {
        return [
            'vigencia_sat' => 'date',
            'registrado' => 'boolean',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function infCredito()
    {
        return $this->belongsTo(InfCredito::class);
    }

    public function infContrato()
    {
        return $this->belongsTo(InfContrato::class);
    }

    public function usuariosProveedores()
    {
        return $this->hasOne(UsuariosProveedores::class);
    }

    public function informacionBancaria()
    {
        return $this->hasMany(InformacionBancaria::class);                                                                                                                                                                                                                                                                                                                                                                                                                  
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function datosProveedor()
    {
        return $this->hasOne(DatosProveedor::class);
    }

    public function proveedorServicio()
    {
        return $this->belongsToMany(ProductoServicio::class, 'proveedor_servicios', 'proveedor_id', 'producto_servicio_id')->withTimestamps();
    }

    public function provContacto()
    {
        return $this->belongsToMany(Cotizacion::class, 'prov_contactos', 'proveedor_id', 'cotizacion_id')->withTimestamps();
    }

    public function oficiosProducto()
    {
        return $this->hasMany(OficiosProductos::class);
    }

    public function oficiosRepSe()
    {
        return $this->hasMany(OficiosRepse::class);
    }
}
