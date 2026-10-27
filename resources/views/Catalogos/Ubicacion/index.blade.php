<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones</title>
</head>

<body>

    <h1>Catálogo de Ubicaciones</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('ubicacion.create') }}">
        Nueva ubicación
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

            @forelse ($ubicaciones as $ubicacion)

                <tr>
                    <td>{{ $ubicacion->id }}</td>
                    <td>{{ $ubicacion->nombre }}</td>

                    <td>
                        <a href="{{ route('ubicacion.edit', $ubicacion) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('ubicacion.destroy', $ubicacion) }}"
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
                        No hay ubicaciones registradas.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>