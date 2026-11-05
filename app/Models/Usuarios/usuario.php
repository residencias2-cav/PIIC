<?php

namespace App\Models\Usuarios;

use App\Models\Catalogos\Gerencia;
use App\Models\Catalogos\TipoUsuario;
use App\Models\Oficios\Oficios;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'usuarios';

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
            'twofa_expire' => 'datetime',
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

    public function getAuthPassword(): string
    {
        return $this->contrasena_correo;
    }

    public function areasPermitidas(): array
    {
        $codigoGerencia = $this->gerencia?->code;

        if (! $codigoGerencia) {
            return [];
        }

        return config("areas.{$codigoGerencia}", []);
    }

    public function puedeAccederArea(string $area): bool
    {
        return array_key_exists($area, $this->areasPermitidas());
    }

    public function destinatarios()
    {
        return $this->belongsToMany(
            Oficios::class,
            'destinatarios',
            'usuario_id',
            'oficios_id'
        );
    }
}
