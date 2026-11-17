<?php

namespace App\Models\Compras;

use App\Models\Catalogos\Unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosCotizacion extends Model
{
    /** @use HasFactory<\Database\Factories\DatosCotizacionFactory> */
    use HasFactory;

    protected $table = 'datos_cotizacions';

    protected $fillable = [
        'cotizacion_id',
        'unidad_id',
        'descripcion',
        'codigo',
        'entregado',
        'fecha_r'
    ];

    protected function casts(): array
    {
        return [
            'entregado' => 'boolean'
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
