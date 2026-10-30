<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Información de Créditos</title>

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
                        Información de Créditos
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de los créditos registrados.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('inf_credito.create') }}"
                class="btn btn-principal"
            >
                Nuevo crédito
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
                            <th>Monto</th>
                            <th>Vigencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($infCreditos as $infCredito)

                            <tr>

                                <td>
                                    {{ $infCredito->id }}
                                </td>

                                <td>
                                    ${{ number_format($infCredito->monto, 3) }}
                                </td>

                                <td>
                                    {{ $infCredito->vigencia }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('inf_credito.edit', $infCredito) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('inf_credito.destroy', $infCredito) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este crédito?');"
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
                                        No hay créditos registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un crédito para comenzar.
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