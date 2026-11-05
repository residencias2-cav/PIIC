<?php

namespace App\Models\Usuarios;

use App\Models\Oficios\Oficios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Catalogos\{
    Gerencia,
    TipoUsuario
    };
use app\Models\Usuarios\Trabajador;

class Usuario extends Model
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory;

    protected $table = "usuarios";

    protected $fillable = [
        'trabajador_id',
        'gerencia_id',
        'usuario',
        'tipo_usuario_id',
        'tipos_usuario_ch',
        'contrasena',
        'correo',
        'contrasena_correo',
        'twofa_code',
        'twofa_expire',
        'twofa_attempts',
    ];

    protected function casts(): array
    {
        return [
            'trabajador_id' => 'integer',
            'gerencia_id' => 'integer',
            'tipo_usuario_id' => 'integer',
            'tipos_usuario_ch' => 'boolean',
            'twofa_attempts' => 'integer',
        ];
    }

    protected $hidden = [
        'contrasena',
        'contrasena_correo',
        'twofa_code',
        'twofa_expire',
        'twofa_attempts',
        'created_at',
        'updated_at',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }
    
    public function gerencia()
    {
        return $this->belongsTo(Gerencia::class, 'gerencia_id');
    }

    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class);
    }
    
    public function destinatarios()
    {
        return $this->belongsToMany(Oficios::class, 'destinatarios', 'usuario_id', 'destinatario_id');
    }

    public function areasPermitidas(): array
    {
        $codigoGerencia = $this->gerencia?->code;

        if (!$codigoGerencia) {
            return [];
        }

        return config(
            "areas.{$codigoGerencia}",
            []
        );
    }

    public function puedeAccederArea(string $area): bool
    {
        return array_key_exists($area,$this->areasPermitidas());
    }
}
