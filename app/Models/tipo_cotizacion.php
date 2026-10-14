<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_cotizacion extends Model
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
}
