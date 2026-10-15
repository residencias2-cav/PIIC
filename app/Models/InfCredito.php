<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfCredito extends Model
{
    /** @use HasFactory<\Database\Factories\InfCreditoFactory> */
    use HasFactory;

    protected $table = 'inf_credito';

    protected $fillable = [
        'Monto',
        'Vigencia',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
