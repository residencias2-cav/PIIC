<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gerencia extends Model
{
    /** @use HasFactory<\Database\Factories\GerenciaFactory> */
    use HasFactory;

    protected $table = 'gerencias';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class);
    }

    public function pedido()
    {
        return $this->hasMany(Pedido::class);
    }
}
