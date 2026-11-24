<?php

namespace App\Models\Proveedores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalogos\Empresa;

class DatosProveedor extends Model
{
    use HasFactory;

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
            'fecha' => 'date',
        ];
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}