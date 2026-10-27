<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Crédito</title>
</head>

<body>

    <h1>Información de Crédito</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('inf_credito.create') }}">
        Nuevo crédito
    </a>

    <br><br>

    <table border="1" cellpadding="8">
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
                    <td>{{ $infCredito->id }}</td>

                    <td>{{ $infCredito->monto }}</td>

                    <td>{{ $infCredito->vigencia }}</td>

                    <td>
                        <a href="{{ route('inf_credito.edit', $infCredito) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('inf_credito.destroy', $infCredito) }}"
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
                    <td colspan="4">
                        No hay información de crédito registrada.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

</body>

</html>