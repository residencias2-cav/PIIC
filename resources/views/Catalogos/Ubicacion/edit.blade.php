<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ubicación</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <h1>Editar Ubicación</h1>

    <form
        action="{{ route('ubicacion.update', $ubicacion) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="nombre">
                Nombre:
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $ubicacion->nombre) }}"
                required
            >

            @error('nombre')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Actualizar
        </button>

        <a href="{{ route('ubicacion.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>