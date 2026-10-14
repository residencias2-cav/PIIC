<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lugar extends Model
{
    /** @use HasFactory<\Database\Factories\LugarFactory> */
    use HasFactory;

    protected $table = 'lugar';

    protected $fillable = [
        'Nombre_Municipio',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
