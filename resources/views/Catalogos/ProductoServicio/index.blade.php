<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Productos y Servicios</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="catalogo-contenedor">

        <header class="catalogo-header">

            <div class="catalogo-header-info">

                <div class="catalogo-linea"></div>

                <div>
                    <h1 class="catalogo-titulo">
                        Productos y Servicios
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de los productos y servicios registrados.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('producto_servicio.create') }}"
                class="btn btn-principal"
            >
                Nuevo producto o servicio
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
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($productoServicios as $productoServicio)

                            <tr>

                                <td>
                                    {{ $productoServicio->id }}
                                </td>

                                <td>
                                    {{ $productoServicio->nombre }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('producto_servicio.edit', $productoServicio) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('producto_servicio.destroy', $productoServicio) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este producto o servicio?');"
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
                                    colspan="3"
                                    class="estado-vacio"
                                >
                                    <p class="estado-vacio-titulo">
                                        No hay productos o servicios registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un producto o servicio para comenzar.
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