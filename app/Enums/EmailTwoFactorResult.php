<?php

namespace App\Enums;

enum EmailTwoFactorResult: string
{
    case VALIDO = 'valido';

    case INCORRECTO = 'incorrecto';

    case EXPIRADO = 'expirado';

    case LIMITE_INTENTOS = 'limite_intentos';

    case SIN_CODIGO = 'sin_codigo';
}