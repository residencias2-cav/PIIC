<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trabajadores</title>

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
                        Trabajadores
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administra la información
                        de los trabajadores registrados.
                    </p>

                </div>

            </div>


            <a
                href="{{ route('trabajador.create') }}"
                class="btn btn-principal"
            >
                Registrar trabajador
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
                            <th>NT</th>
                            <th>Nombre completo</th>
                            <th>Sexo</th>
                            <th>Fecha nacimiento</th>
                            <th>Lugar nacimiento</th>
                            <th>Tipo sangre</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($trabajadores as $trabajador)

                            <tr>

                                <td>
                                    {{ $trabajador->nt }}
                                </td>


                                <td>
                                    {{ $trabajador->nombre }}
                                    {{ $trabajador->apellido_paterno }}
                                    {{ $trabajador->apellido_materno }}
                                </td>


                                <td>
                                    {{ $trabajador->sexo->value ?? $trabajador->sexo }}
                                </td>


                                <td>
                                    {{ $trabajador->fecha_nacimiento?->format('d/m/Y') }}
                                </td>


                                <td>
                                    {{ $trabajador->lugarNacimiento?->nombre ?? 'Sin registro' }}
                                </td>


                                <td>
                                    {{ $trabajador->tipoSangre?->nombre ?? 'Sin registro' }}
                                </td>


                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route(
                                                'trabajador.edit',
                                                $trabajador
                                            ) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route(
                                                'trabajador.destroy',
                                                $trabajador
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                '¿Deseas eliminar este trabajador?'
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
                                        No hay trabajadores registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un trabajador para comenzar.
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