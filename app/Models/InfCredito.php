<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfCredito extends Model
{
    /** @use HasFactory<\Database\Factories\InfCreditoFactory> */
    use HasFactory;

    protected $table = 'inf_creditos';

    protected $fillable = [
        'Monto',
        'Vigencia',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function infCreditos()
    {
        return $this->hasMany(Proveedor::class);
    }
}
