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
                        Proyectos
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de los proyectos registrados.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('proyecto.create') }}"
                class="btn btn-principal"
            >
                Nuevo proyecto
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

                        @forelse ($proyectos as $proyecto)

                            <tr>

                                <td>
                                    {{ $proyecto->id }}
                                </td>

                                <td>
                                    {{ $proyecto->nombre }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('proyecto.edit', $proyecto) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('proyecto.destroy', $proyecto) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este proyecto?');"
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
                                        No hay proyectos registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un proyecto para comenzar.
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