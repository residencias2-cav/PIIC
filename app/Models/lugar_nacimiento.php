<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lugar_nacimiento extends Model
{
    /** @use HasFactory<\Database\Factories\LugarNacimientoFactory> */
    use HasFactory;

    protected $table = 'lugar_nacimiento';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
