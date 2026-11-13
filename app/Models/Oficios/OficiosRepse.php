<?php

namespace App\Models\Oficios;

use App\Models\Catalogos\{
    Contrato,
    Empresa
};
use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OficiosRepse extends Model
{
    /** @use HasFactory<\Database\Factories\OficiosRepseFactory> */
    use HasFactory;

    protected $table = 'oficios_repses';
    
    protected $fillable = [
        'fecha_firma',
        'contrato_id',
        'oficios_id',
        'proveedor_id',
        'empresa_id',
        'fecha_inicio',
        'fecha_fin',
        'identificacion_contrato',
        'ob_social_ctt',
        'ob_social_cts',
        'repse',
        'folio_actividad',
        'actividad',
        'vigencia',
        'servicio_prestado',
        'precio',
        'iva',
        'total',
        'pago_servicio',
        'correo_contacto',
        'terminacion',
        'contacto_contratante',
        'testigo',
        'productos',
    ];

    protected function casts(): array
    {
        return [
            'fecha_firma' => 'datetime',
            'fecha_inicio' => 'datetime',
            'fecha_fin' => 'datetime',
            'precio' => 'decimal',
            'iva' => 'decimal',
            'total' => 'decimal',
            'pago_servicio' => 'decimal',
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function oficios()
    {
        return $this->belongsTo(Oficios::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
