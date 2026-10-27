<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva ubicación</title>
</head>

<body>

    <h1>Registrar Ubicación</h1>

    <form action="{{ route('ubicacion.store') }}" method="POST">

        @csrf

        <div>
            <label for="nombre">
                Nombre:
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
                required
            >

            @error('nombre')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Guardar
        </button>

        <a href="{{ route('ubicacion.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>