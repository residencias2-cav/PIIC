<?php

namespace App\Models;

use App\Models\Compras\PedidoInterno;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoServicio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoServicioFactory> */
    use HasFactory;
    
    protected $table = 'tipo_servicios';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function tiposServicio()
    {
        return $this->hasMany(PedidoInterno::class);
    }
}
