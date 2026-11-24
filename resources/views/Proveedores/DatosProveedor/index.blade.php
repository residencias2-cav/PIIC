<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Datos de proveedores</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="catalogo-contenedor">

    <!-- ENCABEZADO -->
    <header class="catalogo-header">

        <div class="catalogo-header-info">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="catalogo-titulo">
                    Datos de proveedores
                </h1>

                <p class="catalogo-descripcion">
                    Administración de los datos y la información de los proveedores.
                </p>
            </div>

        </div>

        <a href="{{ route('datos_proveedor.create') }}" class="btn btn-principal">
            Registrar datos
        </a>

    </header>

    <!-- MENSAJE DE ÉXITO -->
    @if(session('success'))
        <div class="mensaje-exito">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLA -->
    <section class="catalogo-card">

        <div class="tabla-responsive">

            <table class="catalogo-tabla">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Folio</th>
                        <th>Proveedor</th>
                        <th>Empresa</th>
                        <th>Fecha</th>
                        <th>Tiempo de entrega</th>
                        <th>Método de entrega</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Tipo de contrato</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($datosProveedores as $dato)

                        <tr>
                            <td>{{ $dato->id }}</td>

                            <td>{{ $dato->folio }}</td>

                            <td>
                                {{ $dato->proveedor->nombre ?? 'Sin proveedor' }}
                            </td>

                            <td>
                                {{ $dato->empresa->nombre ?? 'Sin empresa' }}
                            </td>

                            <td>
                                {{ $dato->fecha?->format('d/m/Y') }}
                            </td>

                            <td>{{ $dato->tiempo_entrega }}</td>

                            <td>{{ $dato->metodo_entrega }}</td>

                            <td>{{ $dato->correo }}</td>

                            <td>{{ $dato->telefono }}</td>

                            <td>{{ $dato->tipo_contrato }}</td>

                            <td>
                                <div class="acciones">

                                    <a href="{{ route('datos_proveedor.edit', $dato->id) }}"
                                       class="btn btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('datos_proveedor.destroy', $dato->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Deseas eliminar este registro?')">

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
                            <td colspan="11" class="estado-vacio">

                                <p class="estado-vacio-titulo">
                                    No hay datos de proveedores registrados.
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra un nuevo dato de proveedor para comenzar.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{ $datosProveedores->links() }}

    </section>

</main>

</body>
</html>