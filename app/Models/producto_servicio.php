<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto_servicio extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoServicioFactory> */
    use HasFactory;

    protected $table = 'producto_servicio';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
