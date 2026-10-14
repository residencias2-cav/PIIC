<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    /** @use HasFactory<\Database\Factories\ArticuloFactory> */
    use HasFactory;

    protected $table = 'articulo';

    protected $fillable = [
        "nombre",
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
