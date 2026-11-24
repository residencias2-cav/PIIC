<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pagos</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">

        <div class="catalogo-header-info">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="catalogo-titulo">Pagos</h1>

                <p class="catalogo-descripcion">
                    Administración de los pagos de proveedores.
                </p>
            </div>

        </div>

        <a href="{{ route('pago.create') }}" class="btn btn-principal">
            Registrar pago
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
                        <th>Proveedor</th>
                        <th>Precio</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Descuento</th>
                        <th>Factura</th>
                        <th>Comisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pagos as $pago)

                        <tr>
                            <td>{{ $pago->id }}</td>

                            <td>{{ $pago->proveedor->nombre ?? 'Sin proveedor' }}</td>

                            <td>${{ number_format($pago->precio, 2) }}</td>

                            <td>${{ number_format($pago->iva, 2) }}</td>

                            <td>${{ number_format($pago->total, 2) }}</td>

                            <td>${{ number_format($pago->descuento, 2) }}</td>

                            <td>${{ number_format($pago->factura, 2) }}</td>

                            <td>${{ number_format($pago->comision, 2) }}</td>

                            <td>
                                <div class="acciones">

                                    <a href="{{ route('pago.edit', $pago->id) }}"
                                       class="btn btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('pago.destroy', $pago->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Deseas eliminar este pago?')">

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
                            <td colspan="9" class="estado-vacio">

                                <p class="estado-vacio-titulo">
                                    No hay pagos registrados.
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra un nuevo pago para comenzar.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{ $pagos->links() }}

    </section>

</main>

</body>
</html>