<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar lugar</title>
</head>

<body>

    <h1>Editar Lugar</h1>

    <form
        action="{{ route('lugar.update', $lugar) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="nombre_municipio">
                Nombre del municipio:
            </label>

            <input
                type="text"
                id="nombre_municipio"
                name="nombre_municipio"
                value="{{ old('nombre_municipio', $lugar->nombre_municipio) }}"
                required
            >

            @error('nombre_municipio')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Actualizar
        </button>

        <a href="{{ route('lugar.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>