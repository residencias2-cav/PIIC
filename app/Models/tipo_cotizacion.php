<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_cotizacion extends Model
{
    /** @use HasFactory<\Database\Factories\TipoCotizacionFactory> */
    use HasFactory;
    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
