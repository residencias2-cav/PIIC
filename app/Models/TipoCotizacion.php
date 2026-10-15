<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoCotizacion extends Model
{
    /** @use HasFactory<\Database\Factories\TipoCotizacionFactory> */
    use HasFactory;

    protected $table = 'tipo_cotizacions';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function tiposCotizacion()
    {
        return $this->hasMany(Cotizacion::class);
    }
}
