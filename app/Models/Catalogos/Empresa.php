<?php

namespace App\Models\Catalogos;

use App\Models\Compras\Pedido;
use App\Models\Epp\Epp;
use App\Models\Oficios\OficiosRepse;
use App\Models\Proveedores\DatosProveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    /** @use HasFactory<\Database\Factories\EmpresaFactory> */
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'rfc',
        'dom_fiscal',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function datosProveedores(): HasMany
    {
        return $this->hasMany(DatosProveedor::class);
    }

    public function epp(): HasMany
    {
        return $this->hasMany(Epp::class);
    }

    public function oficiosRepSe(): HasMany
    {
        return $this->hasMany(OficiosRepse::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}
