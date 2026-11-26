<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar pedido</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>
        <div>
            <h1 class="formulario-titulo">Revisar pedido</h1>
            <p class="formulario-descripcion">
                Consulta la información del pedido antes de autorizarlo.
            </p>
        </div>
    </header>

    @php
        $pedido = $autorizacion->pedido;
        $tipoPedido = $pedido?->tipoPedido?->nombre;
    @endphp

    @if($pedido)

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">
                Información general del pedido
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label>Folio</label>
                    <input type="text" value="{{ $pedido->folio }}" readonly>
                </div>

                <div class="campo">
                    <label>Fecha</label>
                    <input type="text" value="{{ $pedido->fecha?->format('d/m/Y') }}" readonly>
                </div>

                <div class="campo">
                    <label>Tipo de pedido</label>
                    <input type="text" value="{{ $tipoPedido ?? 'Sin tipo' }}" readonly>
                </div>

                <div class="campo">
                    <label>Gerencia</label>
                    <input type="text" value="{{ $pedido->gerencia?->code ?? 'Sin gerencia' }}" readonly>
                </div>

                <div class="campo">
                    <label>Empresa</label>
                    <input type="text" value="{{ $pedido->empresa?->nombre ?? 'Sin empresa' }}" readonly>
                </div>

                <div class="campo">
                    <label>Monto</label>
                    <input type="text" value="{{ $pedido->monto ?? 'Sin monto' }}" readonly>
                </div>

                <div class="campo">
                    <label>Usuario solicitante</label>
                    <input type="text"
                           value="{{ $autorizacion->usuario?->trabajador
                                ? $autorizacion->usuario->trabajador->nombre . ' ' .
                                  $autorizacion->usuario->trabajador->apellido_paterno . ' ' .
                                  $autorizacion->usuario->trabajador->apellido_materno
                                : ($autorizacion->usuario?->usuario ?? 'Sin usuario') }}"
                           readonly>
                </div>

                <div class="campo">
                    <label>Observaciones del pedido</label>
                    <textarea rows="3" readonly>{{ $pedido->observaciones }}</textarea>
                </div>

            </div>
        </section>

        @if($tipoPedido === 'Pedido alm')

            <section class="formulario-seccion">
                <h2 class="formulario-seccion-titulo">
                    Detalles del pedido ALM
                </h2>

                @if($pedido->detallesPedido->count() > 0)

                    <div class="tabla-responsive">
                        <table class="catalogo-tabla">
                            <thead>
                                <tr>
                                    <th>Partida</th>
                                    <th>Cantidad</th>
                                    <th>Unidad</th>
                                    <th>Descripción</th>
                                    <th>Uso</th>
                                    <th>Crédito</th>
                                    <th>Fecha de pago</th>
                                    <th>Código</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($pedido->detallesPedido as $detalle)
                                    <tr>
                                        <td>{{ $detalle->partida }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ $detalle->unidad?->nombre ?? 'Sin unidad' }}</td>
                                        <td>{{ $detalle->descripcion }}</td>
                                        <td>{{ $detalle->uso }}</td>
                                        <td>{{ $detalle->credito ? 'Sí' : 'No' }}</td>
                                        <td>{{ $detalle->fecha_pago?->format('d/m/Y') }}</td>
                                        <td>{{ $detalle->codigo }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <p class="estado-vacio-texto">
                        Este pedido no tiene detalles registrados.
                    </p>
                @endif
            </section>

        @elseif($tipoPedido === 'Pedido int')

            <section class="formulario-seccion">
                <h2 class="formulario-seccion-titulo">
                    Detalles del pedido interno
                </h2>

                @if($pedido->pedidosInternos->count() > 0)

                    <div class="tabla-responsive">
                        <table class="catalogo-tabla">
                            <thead>
                                <tr>
                                    <th>Tipo de servicio</th>
                                    <th>Descripción</th>
                                    <th>Fecha de entrega</th>
                                    <th>Fecha de devolución</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($pedido->pedidosInternos as $interno)
                                    <tr>
                                        <td>{{ $interno->tipoServicio?->nombre ?? 'Sin tipo de servicio' }}</td>
                                        <td>{{ $interno->descripcion }}</td>
                                        <td>{{ $interno->fecha_entrega?->format('d/m/Y') }}</td>
                                        <td>{{ $interno->fecha_devolucion?->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <p class="estado-vacio-texto">
                        Este pedido no tiene detalles internos registrados.
                    </p>
                @endif
            </section>

        @endif

    @else

        <div class="mensaje-error">
            No se encontró la información del pedido.
        </div>

    @endif

    <form action="{{ route('autorizacion.update', $autorizacion->id) }}" method="POST">

        @csrf
        @method('PUT')

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">
                Autorizar pedido
            </h2>

            <div class="formulario-grid">
                <div class="campo">
                    <label for="observaciones">Observaciones de autorización</label>

                    <textarea name="observaciones"
                              id="observaciones"
                              rows="4"
                              maxlength="150">{{ old('observaciones', $autorizacion->observaciones) }}</textarea>

                    @error('observaciones')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </section>

        <div class="formulario-acciones">

            <a href="{{ route('autorizacion.index') }}" class="btn btn-secundario">
                Regresar
            </a>

            <button type="submit"
                    class="btn btn-principal"
                    onclick="return confirm('¿Estás seguro de autorizar este pedido?')">
                Autorizar pedido
            </button>

        </div>

    </form>

</main>

</body>
</html>