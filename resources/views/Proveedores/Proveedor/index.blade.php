<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Proveedores</title>

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
                    Proveedores
                </h1>

                <p class="catalogo-descripcion">
                    Consulta y administra los proveedores registrados.
                </p>
            </div>

        </div>

        <a
            href="{{ route('proveedor.create') }}"
            class="btn btn-principal"
        >
            Registrar proveedor
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
                        <th>Nombre</th>
                        <th>Razón social</th>
                        <th>RFC</th>
                        <th>Área</th>
                        <th>Vigencia SAT</th>
                        <th>Registrado</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($proveedores as $proveedor)

                        <tr>

                            <td>
                                {{ $proveedor->nombre }}
                            </td>

                            <td>
                                {{ $proveedor->razon_social }}
                            </td>

                            <td>
                                {{ $proveedor->rfc }}
                            </td>

                            <td>
                                {{ $proveedor->area }}
                            </td>

                            <td>
                                {{ $proveedor->vigencia_sat?->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $proveedor->registrado ? 'Sí' : 'No' }}
                            </td>

                            <td>

                                <div class="acciones">

                                    <a
                                        href="{{ route(
                                            'proveedor.edit',
                                            $proveedor
                                        ) }}"
                                        class="btn btn-editar"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route(
                                            'proveedor.destroy',
                                            $proveedor
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            '¿Deseas eliminar este proveedor?'
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
                                    No hay proveedores registrados
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra un proveedor para comenzar.
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