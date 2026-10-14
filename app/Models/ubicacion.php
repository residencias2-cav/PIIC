<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ubicacion extends Model
{
    /** @use HasFactory<\Database\Factories\UbicacionFactory> */
    use HasFactory;

    protected $table = 'ubicacion';

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
