<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo lugar</title>
</head>

<body>

    <h1>Registrar Lugar</h1>

    <form action="{{ route('lugar.store') }}" method="POST">

        @csrf

        <div>
            <label for="nombre_municipio">
                Nombre del municipio:
            </label>

            <input
                type="text"
                id="nombre_municipio"
                name="nombre_municipio"
                value="{{ old('nombre_municipio') }}"
                required
            >

            @error('nombre_municipio')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Guardar
        </button>

        <a href="{{ route('lugar.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>