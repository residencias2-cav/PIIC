<?php

namespace App\Models\Usuarios;

use App\Models\Catalogos\Gerencia;
use App\Models\Catalogos\TipoUsuario;
use App\Models\Oficios\Oficios;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'usuarios';

    protected $fillable = [
        'trabajador_id',
        'gerencia_id',
        'usuario',
        'tipo_usuario_id',
        'tipos_usuario_ch',
        'contrasena',
        'correo',
        'password',
    ];

    protected $hidden = [
        'contrasena',
        'password',
        'remember_Token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'email_2fa_code_hash',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'contrasena' => 'hashed',
            'two_factor_confirmed_at' => 'datetime'
        ];
    }

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

    public function getAuthPasswordName(): string
    {
        return 'contrasena';
    }

    public function getAuthPassword(): string
    {
        return $this->contrasena;
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

    public function esAdmin(): bool
    {
        return $this->tipoUsuario?->nombre === 'ADMIN';
    }
    
    public function esSubDirector(): bool
    {
        return $this->tipoUsuario?->nombre === 'Director';
    }
    
    public function esSupervisor(): bool
    {
        return $this->tipoUsuario?->nombre === 'Supervisor';
    }
    
    public function esGerente(): bool
    {
        return $this->tipoUsuario?->nombre === 'Gerente';
    }
    
    public function esOperativo(): bool
    {
        return $this->tipoUsuario?->nombre === 'Operativo';
    }

    public function esAdministrativo(): bool
    {
        return $this->tipoUsuario?->nombre === 'Administrativo';
    }
    
    public function esInvitado(): bool
    {
        return $this->tipoUsuario?->nombre === 'Invitado';
    }
    
    public function esProveedor(): bool
    {
        return $this->tipoUsuario?->nombre === 'Proveedor';
    }
    
    public function esCompras(): bool
    {
        return $this->tipoUsuario?->nombre === 'Compras';
    }

    public function routeNotificationForMail(
        mixed $notification = null
    ): string {
        return $this->correo;
    }
}
