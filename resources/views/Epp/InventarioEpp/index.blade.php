<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Inventario EPP</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

    <main class="catalogo-contenedor">

        {{-- Encabezado --}}
        <header class="catalogo-header">

            <div class="catalogo-header-info">

                <div class="catalogo-linea"></div>

                <div>

                    <h1 class="catalogo-titulo">
                        Inventario EPP
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administra las existencias
                        de equipo de protección personal.
                    </p>

                </div>

            </div>


            <a
                href="{{ route('inventario_epp.create') }}"
                class="btn btn-principal"
            >
                Registrar inventario
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
                            <th>Artículo</th>
                            <th>Talla</th>
                            <th>Existencia</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($inventarios as $inventario)

                            <tr>

                                <td>
                                    {{ $inventario->id }}
                                </td>


                                <td>
                                    {{ $inventario->articulo?->nombre ?? 'Sin artículo' }}
                                </td>


                                <td>
                                    {{ $inventario->talla }}
                                </td>


                                <td>
                                    {{ $inventario->existencia }}
                                </td>


                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route(
                                                'inventario_epp.edit',
                                                $inventario
                                            ) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route(
                                                'inventario_epp.destroy',
                                                $inventario
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                '¿Deseas eliminar este registro del inventario?'
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
                                    colspan="5"
                                    class="estado-vacio"
                                >

                                    <p class="estado-vacio-titulo">
                                        No hay registros de inventario EPP
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra una existencia para comenzar.
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