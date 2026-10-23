<?php

namespace App\Models;

use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfContrato extends Model
{
    /** @use HasFactory<\Database\Factories\InfContratoFactory> */
    use HasFactory;

    protected $table = 'inf_contratos';

    protected $fillable = [
        'tipo_contrato',
        'vigencia',
    ];

    protected function casts(): array
    {
        return [
            'vigencia' => 'date',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function infContratos()
    {
        return $this->hasMany(Proveedor::class);
    }
}
