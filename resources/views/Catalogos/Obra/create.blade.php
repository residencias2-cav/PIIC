<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva obra</title>
</head>

<body>

    <h1>Registrar Obra</h1>

    <form action="{{ route('obra.store') }}" method="POST">

        @csrf

        <div>

            <label for="nombre_obra">
                Nombre de la obra:
            </label>

            <input
                type="text"
                id="nombre_obra"
                name="nombre_obra"
                value="{{ old('nombre_obra') }}"
                required
            >

            @error('nombre_obra')
                <p>{{ $message }}</p>
            @enderror

        </div>

        <br>

        <button type="submit">
            Guardar
        </button>

        <a href="{{ route('obra.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>