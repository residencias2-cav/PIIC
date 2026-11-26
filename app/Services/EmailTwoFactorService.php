<?php

namespace App\Services;

use App\Models\Usuarios\Usuario;
use App\Notifications\CodigoAccesoDosFactores;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EmailTwoFactorService
{
    public const EXPIRATION_MINUTES = 5;

    public const MAX_ATTEMPTS = 5;

    public const RESEND_SECONDS = 60;

    /**
     * Genera, almacena y envía un nuevo código.
     */
    public function sendCode(
        Usuario $usuario
    ): void {
        if (
            $usuario->email_2fa_last_sent_at
            &&
            $usuario->email_2fa_last_sent_at
                ->addSeconds(self::RESEND_SECONDS)
                ->isFuture()
        ) {
            throw ValidationException::withMessages([
                'codigo' =>
                    'Debes esperar antes de solicitar otro código.',
            ]);
        }

        $codigo = (string) random_int(
            100000,
            999999
        );

        $usuario->forceFill([
            'email_2fa_code_hash' =>
                Hash::make($codigo),

            'email_2fa_expires_at' =>
                now()->addMinutes(
                    self::EXPIRATION_MINUTES
                ),

            'email_2fa_attempts' => 0,

            'email_2fa_last_sent_at' => now(),
        ])->save();

        $usuario->notify(
            new CodigoAccesoDosFactores(
                $codigo
            )
        );
    }

    /**
     * Comprueba un código enviado por correo.
     */
    public function verifyCode(
        Usuario $usuario,
        string $codigo
    ): bool {
        if (
            ! $usuario->email_2fa_code_hash
            ||
            ! $usuario->email_2fa_expires_at
        ) {
            return false;
        }

        if (
            $usuario->email_2fa_attempts
            >= self::MAX_ATTEMPTS
        ) {
            return false;
        }

        if (
            $usuario->email_2fa_expires_at
                ->isPast()
        ) {
            $this->invalidateCode(
                $usuario
            );

            return false;
        }

        if (
            ! Hash::check(
                $codigo,
                $usuario->email_2fa_code_hash
            )
        ) {
            $usuario->increment(
                'email_2fa_attempts'
            );

            return false;
        }

        $this->invalidateCode(
            $usuario
        );

        return true;
    }

    /**
     * Invalida el código después de utilizarlo
     * o cuando deja de ser válido.
     */
    public function invalidateCode(
        Usuario $usuario
    ): void {
        $usuario->forceFill([
            'email_2fa_code_hash' => null,
            'email_2fa_expires_at' => null,
            'email_2fa_attempts' => 0,
        ])->save();
    }
}