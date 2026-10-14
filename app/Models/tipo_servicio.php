<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_servicio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoServicioFactory> */
    use HasFactory;
    
    protected $table = 'tipo_servicio';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
