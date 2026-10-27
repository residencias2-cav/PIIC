<?php

namespace App\Models\Usuarios;

use App\Models\Oficios\Oficios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory;

    public function destinatarios()
    {
        return $this->belongsToMany(Oficios::class, 'destinatarios', 'usuario_id', 'destinatario_id');
    }
}
