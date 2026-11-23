<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cotizaciones</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">

        <div class="catalogo-header-info">

            <div class="catalogo-linea"></div>

            <div>

                <h1 class="catalogo-titulo">
                    Cotizaciones
                </h1>

                <p class="catalogo-descripcion">
                    Consulta y administra las cotizaciones registradas.
                </p>

            </div>

        </div>

        <a
            href="{{ route('cotizaciones.create') }}"
            class="btn btn-principal"
        >
            Nueva cotización
        </a>

    </header>

    @if (session('success'))

        <div class="mensaje-exito">
            {{ session('success') }}
        </div>

    @endif

    <section class="catalogo-card">

        <div class="tabla-responsive">

            <table class="catalogo-tabla">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Folio</th>
                        <th>Pedido</th>
                        <th>Fecha</th>
                        <th>Gerencia</th>
                        <th>Proyecto</th>
                        <th>Estado</th>
                        <th>Detalles</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($cotizaciones as $cotizacion)

                        <tr>

                            <td>
                                {{ $cotizacion->id }}
                            </td>

                            <td>
                                {{ $cotizacion->folio }}
                            </td>

                            <td>
                                {{ $cotizacion->pedido_id }}
                            </td>

                            <td>
                                {{ $cotizacion->fecha
                                    ? \Carbon\Carbon::parse($cotizacion->fecha)->format('d/m/Y')
                                    : 'Sin fecha' }}
                            </td>

                            <td>
                                {{ $cotizacion->gerencia?->nombre ?? 'No disponible' }}
                            </td>

                            <td>
                                {{ $cotizacion->proyecto?->nombre ?? 'No disponible' }}
                            </td>

                            <td>
                                {{ $cotizacion->estadoPedido?->nombre
                                    ?? $cotizacion->estado_pedido_id }}
                            </td>

                            <td>
                                {{ $cotizacion->datosCotizacion->count() }}
                            </td>

                            <td>

                                <div class="acciones">

                                    <a
                                        href="{{ route('cotizaciones.edit', $cotizacion) }}"
                                        class="btn btn-editar"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('cotizaciones.destroy', $cotizacion) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Deseas eliminar esta cotización?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-eliminar"
                                        >
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="estado-vacio">

                                <p class="estado-vacio-titulo">
                                    No hay cotizaciones registradas
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra una cotización para comenzar.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    {{ $cotizaciones->links() }}

</main>

</body>

</html>