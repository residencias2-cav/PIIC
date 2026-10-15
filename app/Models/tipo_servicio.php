<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo_Servicio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoServicioFactory> */
    use HasFactory;
    
    protected $table = 'tipo_servicio';

    protected $fillable = [
        'Nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function tipos_servicio()
    {
        return $this->hasMany(Pedido_Interno::class);
    }
}
