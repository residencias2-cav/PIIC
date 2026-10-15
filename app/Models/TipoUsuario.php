<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    /** @use HasFactory<\Database\Factories\TipoUsuarioFactory> */
    use HasFactory;

    protected $table = 'tipo_usuarios';

    protected $fillable = [
        'nombre',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    public function usuariosProveedores()
    {
        return $this->hasMany(UsuarioProveedor::class);
    }
}
