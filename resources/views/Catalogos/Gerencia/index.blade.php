<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerencias</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="catalogo-contenedor">

        <header class="catalogo-header">

            <div class="catalogo-header-info">

                <div class="catalogo-linea"></div>

                <div>
                    <h1 class="catalogo-titulo">
                        Gerencias
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de las gerencias registradas.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('gerencia.create') }}"
                class="btn btn-principal"
            >
                Nueva gerencia
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
                            <th>Código</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($gerencias as $gerencia)

                            <tr>

                                <td>
                                    {{ $gerencia->id }}
                                </td>

                                <td>
                                    {{ $gerencia->nombre }}
                                </td>

                                <td>
                                    <span class="badge badge-rojo">
                                        {{ $gerencia->code }}
                                    </span>
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('gerencia.edit', $gerencia) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('gerencia.destroy', $gerencia) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar esta gerencia?');"
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
                                    colspan="4"
                                    class="estado-vacio"
                                >
                                    <p class="estado-vacio-titulo">
                                        No hay gerencias registradas
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra una gerencia para comenzar.
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