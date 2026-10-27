<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos</title>
</head>

<body>

    <h1>Catálogo de Artículos</h1>

    @if (session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('articulo.create') }}">
        Nuevo artículo
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
            @forelse ($articulos as $articulo)

                <tr>
                    <td>{{ $articulo->id }}</td>

                    <td>{{ $articulo->nombre }}</td>

                    <td>
                        <a href="{{ route('articulo.edit', $articulo) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('articulo.destroy', $articulo) }}"
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
                        No hay artículos registrados.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

</body>

</html>