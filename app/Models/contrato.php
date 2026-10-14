<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contrato extends Model
{
    /** @use HasFactory<\Database\Factories\ContratoFactory> */
    use HasFactory;

    protected $table = 'contrato';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
