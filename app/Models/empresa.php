<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    /** @use HasFactory<\Database\Factories\EmpresaFactory> */
    use HasFactory;

    protected $table = 'empresa';

    protected $fillable = [
        'Nombre',
        'RFC',
        'Dom_fiscal',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
