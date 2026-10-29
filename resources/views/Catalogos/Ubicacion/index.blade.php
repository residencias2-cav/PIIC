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
                        Catálogo de Ubicaciones
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de las ubicaciones registradas.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('ubicacion.create') }}"
                class="btn btn-principal"
            >
                Nueva ubicación
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

                        @forelse ($ubicacions as $ubicacion)

                            <tr>

                                <td>
                                    {{ $ubicacion->id }}
                                </td>

                                <td>
                                    {{ $ubicacion->nombre }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('ubicacion.edit', $ubicacion) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('ubicación.destroy', $ubicación) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar esta ubicación?');"
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
                                        No hay ubicaciones registradas
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra una ubicación para comenzar.
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