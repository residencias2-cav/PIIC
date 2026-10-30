<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catalogos de obras</title>

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
                        Obras
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de las obras registradas.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('obra.create') }}"
                class="btn btn-principal"
            >
                Nueva Obra
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
                            <th>Nombre  de Obra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($obras as $obra)

                            <tr>

                                <td>
                                    {{ $obra->id }}
                                </td>

                                <td>
                                    {{ $obra->nombre_obra }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('obra.edit', $obra) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('obra.destroy', $obra) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar esta obra?');"
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
                                        No hay obras registradas
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra una obra para comenzar.
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