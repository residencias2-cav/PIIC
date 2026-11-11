<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Oficios</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">

        <div class="catalogo-header-info">

            <div class="catalogo-linea"></div>

            <div>

                <h1 class="catalogo-titulo">
                    Oficios
                </h1>

                <p class="catalogo-descripcion">
                    Consulta y administra los oficios registrados.
                </p>

            </div>

        </div>


        <a
            href="{{ route('oficio.create') }}"
            class="btn btn-principal"
        >
            Nuevo oficio
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
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Asunto</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($oficios as $oficio)

                        <tr>

                            <td>
                                {{ $oficio->folio }}
                            </td>

                            <td>
                                {{ $oficio->fecha?->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $oficio->asunto }}
                            </td>

                            <td>
                                {{ $oficio->tipoOficio?->nombre ?? 'Sin tipo' }}
                            </td>

                            <td>
                                {{ $oficio->estado?->nombre_estado ?? 'Sin estado' }}
                            </td>

                            <td>
                                {{ $oficio->observaciones }}
                            </td>

                            <td>

                                <div class="acciones">

                                    <a
                                        href="{{ route(
                                            'oficio.edit',
                                            $oficio
                                        ) }}"
                                        class="btn btn-editar"
                                    >
                                        Editar
                                    </a>


                                    <form
                                        action="{{ route(
                                            'oficio.destroy',
                                            $oficio
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            '¿Deseas eliminar este oficio?'
                                        );"
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
                                colspan="7"
                                class="estado-vacio"
                            >

                                <p class="estado-vacio-titulo">
                                    No hay oficios registrados
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra un oficio para comenzar.
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