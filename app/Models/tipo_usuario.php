<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_usuario extends Model
{
    /** @use HasFactory<\Database\Factories\TipoUsuarioFactory> */
    use HasFactory;

    protected $table = 'tipo_usuario';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
