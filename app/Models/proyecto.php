<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    /** @use HasFactory<\Database\Factories\ProyectoFactory> */
    use HasFactory;
    
    protected $table = 'proyecto';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class);
    }
}
