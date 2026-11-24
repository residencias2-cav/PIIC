<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores y productos o servicios</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Proveedores y productos o servicios</h1>
                <p class="catalogo-descripcion">
                    Consulta y administra los productos y servicios asociados a cada proveedor.
                </p>
            </div>
        </div>

        <a href="{{ route('proveedor_servicio.create') }}" class="btn btn-principal">
            Nueva relación
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
                        <th>Proveedor</th>
                        <th>Producto o servicio</th>
                        <th>Fecha de registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($proveedorServicios as $proveedorServicio)
                        <tr>
                            <td>
                                {{ $proveedorServicio->proveedor->nombre ?? 'Proveedor no disponible' }}
                            </td>

                            <td>
                                {{ $proveedorServicio->productoServicio->nombre ?? 'Producto o servicio no disponible' }}
                            </td>

                            <td>
                                {{ $proveedorServicio->created_at
                                    ? $proveedorServicio->created_at->format('d/m/Y')
                                    : 'Sin fecha' }}
                            </td>

                            <td>
                                <div class="acciones">

                                    <a href="{{ route('proveedor_servicio.edit', [
                                        $proveedorServicio->proveedor_id,
                                        $proveedorServicio->producto_servicio_id
                                    ]) }}"
                                       class="btn btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('proveedor_servicio.destroy', [
                                        $proveedorServicio->proveedor_id,
                                        $proveedorServicio->producto_servicio_id
                                    ]) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás segura de eliminar esta relación?')">

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
                            <td colspan="4" class="estado-vacio">
                                <p class="estado-vacio-titulo">
                                    No hay relaciones registradas.
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra una nueva relación para comenzar.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        @if(method_exists($proveedorServicios, 'links'))
            {{ $proveedorServicios->links() }}
        @endif

    </section>

</main>

</body>
</html>