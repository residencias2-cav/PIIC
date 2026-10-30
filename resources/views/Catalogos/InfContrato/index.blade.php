<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Información de Contratos</title>

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
                        Información de Contratos
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de los contratos registrados.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('inf_contrato.create') }}"
                class="btn btn-principal"
            >
                Nuevo contrato
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
                            <th>Tipo de contrato</th>
                            <th>Vigencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($infContratos as $infContrato)

                            <tr>

                                <td>
                                    {{ $infContrato->id }}
                                </td>

                                <td>
                                    {{ $infContrato->tipo_contrato }}
                                </td>

                                <td>
                                    {{ $infContrato->vigencia }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('inf_contrato.edit', $infContrato) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('inf_contrato.destroy', $infContrato) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este contrato?');"
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
                                        No hay contratos registrados
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra un contrato para comenzar.
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