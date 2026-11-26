<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CodigoAccesoDosFactores extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $codigo
    ) {
    }

    public function via(object $notifiable): array
    {
        return [
            'mail',
        ];
    }

    public function toMail(
        object $notifiable
    ): MailMessage {
        return (new MailMessage)
            ->subject(
                'Código de verificación de PIIC'
            )
            ->greeting(
                'Verificación de acceso'
            )
            ->line(
                'Se solicitó el acceso a tu cuenta del Sistema PIIC.'
            )
            ->line(
                'Tu código de verificación es:'
            )
            ->line($this->codigo)
            ->line(
                'El código es válido durante 5 minutos.'
            )
            ->line(
                'Si no intentaste iniciar sesión, informa al área de Sistemas.'
            );
    }
}