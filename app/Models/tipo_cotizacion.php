<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo_Cotizacion extends Model
{
    /** @use HasFactory<\Database\Factories\TipoCotizacionFactory> */
    use HasFactory;

    protected $table = 'tipo_cotizacion';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function tipos_cotizacion()
    {
        return $this->hasMany(Cotizacion::class);
    }
}
