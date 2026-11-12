<?php

namespace App\Models\Proveedores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionBancaria extends Model
{
    /** @use HasFactory<\Database\Factories\InformacionBancariaFactory> */
    use HasFactory;

    protected $table = 'informacion_bancarias';

    protected $fillable = [
        'nombre_banco',
        'nombre_titular',
        'cuenta',
        'clave',
        'proveedor_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
