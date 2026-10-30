<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lugares</title>

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
                        Lugares
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de los lugares registrados.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('lugar.create') }}"
                class="btn btn-principal"
            >
                Nuevo lugar
            </a>

        </header>


        {{-- Mensaje de éxito --}}
        @if (session('success'))

            <div class="mensaje-exito">
                {{ session('success') }}
            </div>

        @endif


        {{-- Tabla --}}
        <section class="catalogo-card">

            <div class="tabla-responsive">

                <table class="catalogo-tabla">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Municipio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($lugars as $lugar)

                            <tr>

                                <td>
                                    {{ $lugar->id }}
                                </td>

                                <td>
                                    {{ $lugar->nombre_municipio }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('lugar.edit', $lugar) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('lugar.destroy', $lugar) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este lugar?');"
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
                                        No hay lugares registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un lugar para comenzar.
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