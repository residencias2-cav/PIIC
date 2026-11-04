<?php

namespace App\Models\Usuarios;

use App\Models\Oficios\Oficios;
use App\Models\Catalogos\Gerencia;
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
        'contraseña_correo',
    ];

    protected $hidden = [
        'contraseña_correo',
        'twofa_code',
    ];

    protected function casts(): array
    {
        return [
            'twofa_expire' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Contraseña utilizada por Laravel para autenticación
    |--------------------------------------------------------------------------
    */

    public function getAuthPassword(): string
    {
        return $this->contraseña_correo;
    }

    /*
    |--------------------------------------------------------------------------
    | Gerencia
    |--------------------------------------------------------------------------
    */

    public function gerencia()
    {
        return $this->belongsTo(
            Gerencia::class,
            'gerencia_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Áreas permitidas según la gerencia
    |--------------------------------------------------------------------------
    */

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
        return array_key_exists(
            $area,
            $this->areasPermitidas()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Oficios / destinatarios
    |--------------------------------------------------------------------------
    */

    public function destinatarios()
    {
        return $this->belongsToMany(
            Oficios::class,
            'destinatarios',
            'usuario_id',
            'destinatario_id'
        );
    }
}
