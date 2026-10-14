<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_epp extends Model
{
    /** @use HasFactory<\Database\Factories\TipoEppFactory> */
    use HasFactory;

    protected $table = 'tipo_epp';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
