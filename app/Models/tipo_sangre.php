<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_sangre extends Model
{
    /** @use HasFactory<\Database\Factories\TipoSangreFactory> */
    use HasFactory;

    protected $table = 'tipo_sangre';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
