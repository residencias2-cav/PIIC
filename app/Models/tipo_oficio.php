<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_oficio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoOficioFactory> */
    use HasFactory;

    protected $table = 'tipo_oficio';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
