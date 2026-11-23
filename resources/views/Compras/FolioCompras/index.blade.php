<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folios de compras</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Folios de compras</h1>
                <p class="catalogo-descripcion">
                    Consulta y administra los folios de compras registrados.
                </p>
            </div>
        </div>

        <a href="{{ route('folio_compras.create') }}" class="btn btn-principal">
            Nuevo folio
        </a>
    </header>

    @if(session('success'))
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
                        <th>Pedido</th>
                        <th>Fecha</th>
                        <th>Folio</th>
                        <th>Notas de autorización</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($folioCompras as $folioCompra)
                        <tr>
                            <td>{{ $folioCompra->id }}</td>

                            <td>
                                {{ $folioCompra->pedido_id }}
                            </td>

                            <td>
                                {{ $folioCompra->fecha }}
                            </td>

                            <td>
                                {{ $folioCompra->folio }}
                            </td>

                            <td>
                                {{ $folioCompra->notas_autorizacion }}
                            </td>

                            <td>
                                {{ $folioCompra->observaciones }}
                            </td>

                            <td>
                                <div class="acciones">

                                    <a href="{{ route('folio_compras.edit', $folioCompra->id) }}"
                                       class="btn btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('folio_compras.destroy', $folioCompra->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás segura de eliminar este folio de compra?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-eliminar">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="estado-vacio">
                                <p class="estado-vacio-titulo">
                                    No hay folios de compras registrados.
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra un nuevo folio para comenzar.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        @if(method_exists($folioCompras, 'links'))
            {{ $folioCompras->links() }}
        @endif

    </section>

</main>

</body>
</html>