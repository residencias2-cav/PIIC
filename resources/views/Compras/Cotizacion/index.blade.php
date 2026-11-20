
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cotizaciones</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <h1>Gestión de cotizaciones</h1>
        <p>Consulta y administra las cotizaciones registradas.</p>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="formulario-botones">
        <a href="{{ route('compras.cotizaciones.create') }}">
            Registrar cotización
        </a>
    </div>

    <div class="tabla-contenedor">

        <table>
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

                @forelse($cotizaciones as $cotizacion)

                    <tr>
                        <td>{{ $cotizacion->id }}</td>

                        <td>{{ $cotizacion->folio }}</td>

                        <td>
                            {{ $cotizacion->pedido_id }}
                        </td>

                        <td>
                            {{ $cotizacion->fecha
                                ? \Carbon\Carbon::parse($cotizacion->fecha)->format('d/m/Y')
                                : 'Sin fecha' }}
                        </td>

                        <td>
                            {{ $cotizacion->gerencia->nombre ?? 'No disponible' }}
                        </td>

                        <td>
                            {{ $cotizacion->proyecto->nombre ?? 'No disponible' }}
                        </td>

                        <td>
                            {{ $cotizacion->estadoPedido->nombre
                                ?? $cotizacion->estado_pedido_id }}
                        </td>

                        <td>
                            {{ $cotizacion->datosCotizacion->count() }}
                        </td>

                        <td>

                            <a href="{{ route('compras.cotizaciones.show', $cotizacion->id) }}">
                                Ver
                            </a>

                            <a href="{{ route('compras.cotizaciones.edit', $cotizacion->id) }}">
                                Editar
                            </a>

                            <form action="{{ route('compras.cotizaciones.destroy', $cotizacion->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Deseas eliminar esta cotización?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Eliminar
                                </button>

                            </form>

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="9">
                            No hay cotizaciones registradas.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>

    {{ $cotizaciones->links() }}

</main>

</body>
</html>
