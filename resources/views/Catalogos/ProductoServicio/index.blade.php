<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos y Servicios</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <h1>Catálogo de Productos y Servicios</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('producto_servicio.create') }}">
        Nuevo producto o servicio
    </a>

    <br><br>

    <table border="1" cellpadding="8">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($productosServicios as $productoServicio)

                <tr>
                    <td>{{ $productoServicio->id }}</td>

                    <td>{{ $productoServicio->nombre }}</td>

                    <td>
                        <a href="{{ route('producto_servicio.edit', $productoServicio) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('producto_servicio.destroy', $productoServicio) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="3">
                        No hay productos o servicios registrados.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>