<?php

namespace App\Enums;

enum EstadoSolicitudPedido: string
{
    case BORRADOR = 'BORRADOR';

    case PENDIENTE_GERENCIA =
        'PENDIENTE_GERENCIA';

    case RECHAZADO =
        'RECHAZADO';

    case AUTORIZADO =
        'AUTORIZADO';

    case ENVIADO_COMPRAS =
        'ENVIADO_COMPRAS';
}