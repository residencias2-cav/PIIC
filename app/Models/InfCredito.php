<?php

namespace App\Models;

use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfCredito extends Model
{
    /** @use HasFactory<\Database\Factories\InfCreditoFactory> */
    use HasFactory;

    protected $table = 'inf_creditos';

    protected $fillable = [
        'monto',
        'vigencia',
    ];

    protected function casts(): array
    {
        return [
            'monto'=> 'decimal:2',
            'vigencia'=> 'date',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function infCreditos()
    {
        return $this->hasMany(Proveedor::class);
    }
}
