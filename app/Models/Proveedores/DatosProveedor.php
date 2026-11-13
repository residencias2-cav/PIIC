<?php

namespace App\Models\Proveedores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatosProveedor extends Model
{
    /** @use HasFactory<\Database\Factories\DatosProveedorFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'datos_proveedors';

    protected $fillable = [
        'proveedor_id',
        'folio',
        'fecha',
        'observaciones',
        'tiempo_entrega',
        'metodo_entrega',
        'empresa_id',
        'correo',
        'telefono',
        'direccion',
        'tipo_contrato',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
        ];
    }
}
