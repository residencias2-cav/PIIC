<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pedidos</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">

        <div class="catalogo-header-info">

            <div class="catalogo-linea"></div>

            <div>

                <h1 class="catalogo-titulo">
                    Pedidos
                </h1>

                <p class="catalogo-descripcion">
                    Consulta y administra los pedidos registrados.
                </p>

            </div>

        </div>


        <a
            href="{{ route('pedido.create') }}"
            class="btn btn-principal"
        >
            Nuevo pedido
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
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Tipo pedido</th>
                        <th>Gerencia</th>
                        <th>Empresa</th>
                        <th>Proyecto</th>
                        <th>Estado</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($pedidos as $pedido)

                        <tr>

                            <td>
                                {{ $pedido->folio }}
                            </td>

                            <td>
                                {{ $pedido->fecha?->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $pedido->tipoPedido?->nombre ?? 'Sin tipo' }}
                            </td>

                            <td>
                                {{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}
                            </td>

                            <td>
                                {{ $pedido->empresa?->nombre ?? 'Sin empresa' }}
                            </td>

                            <td>
                                {{ $pedido->proyecto?->nombre ?? 'Sin proyecto' }}
                            </td>

                            <td>
                                {{ $pedido->estado?->nombre_estado ?? 'Sin estado' }}
                            </td>

                            <td>
                                ${{ number_format($pedido->monto ?? 0, 2) }}
                            </td>

                            <td>

                                <div class="acciones">

                                    <a
                                        href="{{ route(
                                            'pedido.edit',
                                            $pedido
                                        ) }}"
                                        class="btn btn-editar"
                                    >
                                        Editar
                                    </a>


                                    <form
                                        action="{{ route(
                                            'pedido.destroy',
                                            $pedido
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            '¿Deseas eliminar este pedido?'
                                        );"
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

                            <td
                                colspan="9"
                                class="estado-vacio"
                            >

                                <p class="estado-vacio-titulo">
                                    No hay pedidos registrados
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra un pedido para comenzar.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</main>

</body>

</html>