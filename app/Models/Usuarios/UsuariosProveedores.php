<?php

namespace App\Models\Usuarios;

use App\Models\Catalogos\TipoUsuario;
use App\Models\Proveedores\Proveedor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosProveedores extends Model
{
    /** @use HasFactory<\Database\Factories\UsuariosProveedoresFactory> */
    use HasFactory;

    protected $table = 'usuarios_proveedores';

    protected $fillable = [
        'usuario',
        'contraseña',
        'proveedor_id',
        'tipo_usuario_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class);
    }
}
