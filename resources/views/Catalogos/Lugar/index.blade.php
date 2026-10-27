<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugares</title>
</head>

<body>

    <h1>Catálogo de Lugares</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('lugar.create') }}">
        Nuevo lugar
    </a>

    <br><br>

    <table border="1" cellpadding="8">

        <thead>
            <tr>
                <th>ID</th>
                <th>Municipio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($lugares as $lugar)

                <tr>
                    <td>{{ $lugar->id }}</td>

                    <td>{{ $lugar->nombre_municipio }}</td>

                    <td>
                        <a href="{{ route('lugar.edit', $lugar) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('lugar.destroy', $lugar) }}"
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
                        No hay lugares registrados.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>