<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Empresas</title>

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
                        Catálogo de Empresas
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de las empresas registradas.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('empresa.create') }}"
                class="btn btn-principal"
            >
                Nueva empresa
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
                            <th>Nombre</th>
                            <th>RFC</th>
                            <th>Domicilio Fiscal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($empresas as $empresa)

                            <tr>

                                <td>
                                    {{ $empresa->id }}
                                </td>

                                <td>
                                    {{ $empresa->nombre }}
                                </td>

                                <td>
                                    {{ $empresa->rfc }}
                                </td>

                                <td>
                                    {{ $empresa->dom_fiscal }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('empresa.edit', $empresa) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('empresa.destroy', $empresa) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar esta empresa?');"
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
                                        No hay empresas registradas
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra una empresa para comenzar.
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