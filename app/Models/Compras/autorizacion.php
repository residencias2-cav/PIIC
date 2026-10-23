<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Model;

class Autorizacion extends Model
{
    /** @use HasFactory<\Database\Factories\AutorizacionFactory> */
    use HasFactory;

    protected $table = 'autorizacions';

    protected $fillable = [
        'usuarios_id',
        'pedidos_id',
        'proceso_autorizado',
        'fecha_autorizacion',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'proceso_autorizado'=>'boolean',
        ];
    }

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }
}
