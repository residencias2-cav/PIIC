<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Artículos</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="catalogo-contenedor">

        {{-- Encabezado --}}
        <header class="catalogo-header">

            <div class="catalogo-header-info">

                <div class="catalogo-linea"></div>

                <div>
                    <h1 class="catalogo-titulo">
                        Catálogo de Artículos
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de los artículos registrados.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('articulo.create') }}"
                class="btn btn-principal"
            >
                Nuevo artículo
            </a>

        </header>


        {{-- Mensaje de éxito --}}
        @if (session('success'))

            <div class="mensaje-exito">
                {{ session('success') }}
            </div>

        @endif


        {{-- Tarjeta de la tabla --}}
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

                        @forelse ($articulos as $articulo)

                            <tr>

                                <td>
                                    {{ $articulo->id }}
                                </td>

                                <td>
                                    {{ $articulo->nombre }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('articulo.edit', $articulo) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('articulo.destroy', $articulo) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este artículo?');"
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
                                        No hay artículos registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un artículo para comenzar.
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