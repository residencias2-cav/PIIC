<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    /** @use HasFactory<\Database\Factories\ContratoFactory> */
    use HasFactory;

    protected $table = 'contrato';

    protected $fillable = [
        "nombre",
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
