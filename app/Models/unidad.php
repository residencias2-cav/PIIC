<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidad extends Model
{
    /** @use HasFactory<\Database\Factories\UnidadFactory> */
    use HasFactory;

    protected $table = 'unidad';

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
