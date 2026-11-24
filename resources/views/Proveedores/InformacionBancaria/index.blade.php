<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información bancaria</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Información bancaria</h1>
                <p class="catalogo-descripcion">
                    Administración de la información bancaria de los proveedores.
                </p>
            </div>
        </div>

        <a href="{{ route('informacion_bancaria.create') }}" class="btn btn-principal">
            Registrar información
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
                        <th>Proveedor</th>
                        <th>Banco</th>
                        <th>Titular</th>
                        <th>Cuenta</th>
                        <th>CLABE</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($informaciones as $informacion)
                        <tr>
                            <td>{{ $informacion->id }}</td>
                            <td>{{ $informacion->proveedor->nombre ?? 'Sin proveedor' }}</td>
                            <td>{{ $informacion->nombre_banco }}</td>
                            <td>{{ $informacion->nombre_titular }}</td>
                            <td>{{ $informacion->cuenta }}</td>
                            <td>{{ $informacion->clave }}</td>

                            <td>
                                <div class="acciones">
                                    <a href="{{ route('informacion_bancaria.edit', $informacion->id) }}"
                                       class="btn btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('informacion_bancaria.destroy', $informacion->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta información bancaria?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-eliminar">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="estado-vacio">
                                    <h3 class="estado-vacio-titulo">
                                        No hay información bancaria registrada
                                    </h3>
                                    <p class="estado-vacio-texto">
                                        Registra la información bancaria de un proveedor para comenzar.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $informaciones->links() }}

    </section>

</main>

</body>
</html>