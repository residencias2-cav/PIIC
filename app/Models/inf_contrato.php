<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inf_contrato extends Model
{
    /** @use HasFactory<\Database\Factories\InfContratoFactory> */
    use HasFactory;

    protected $table = 'inf_contrato';

    protected $fillable = [
        'Tipo_Contrato',
    ];

    protected function casts(): array
{
    return [
        'Vigencia' => 'date',
    ];
}
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
