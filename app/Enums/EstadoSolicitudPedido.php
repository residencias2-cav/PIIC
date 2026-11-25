<?php

namespace App\Enums;

enum EstadoSolicitudPedido: string
{
    case BORRADOR = 'Borrador';

    case RECHAZADO = 'Rechazado';

    case PENDIENTE_GERENCIA = 'Pendiente de gerencia';

    case AUTORIZADO = 'Autorizado';

    case ENVIADO_COMPRAS = 'Enviado a Compras';

    case EN_PROCESO = 'En proceso';

    case ATENDIDO = 'Atendido';
}