<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoFactory> */
    use HasFactory;

    protected $table = 'estado';

    protected $fillable = [
        'Nombre_estado',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
