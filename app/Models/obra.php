<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obra extends Model
{
    /** @use HasFactory<\Database\Factories\ObraFactory> */
    use HasFactory;

    protected $table = 'obra';

    protected $fillable = [
        'Nombre_Obra',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
