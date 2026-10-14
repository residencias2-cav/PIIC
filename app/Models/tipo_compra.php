<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_compra extends Model
{
    /** @use HasFactory<\Database\Factories\TipoCompraFactory> */
    use HasFactory;

    protected $table = 'tipo_compra';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
