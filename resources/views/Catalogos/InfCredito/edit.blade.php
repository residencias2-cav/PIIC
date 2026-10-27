<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar crédito</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <h1>Editar Información de Crédito</h1>

    <form
        action="{{ route('inf_credito.update', $infCredito) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="monto">Monto:</label>

            <input
                type="number"
                id="monto"
                name="monto"
                value="{{ old('monto', $infCredito->monto) }}"
                step="0.001"
                min="0"
                required
            >

            @error('monto')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="vigencia">Vigencia:</label>

            <input
                type="date"
                id="vigencia"
                name="vigencia"
                value="{{ old('vigencia', $infCredito->vigencia) }}"
                required
            >

            @error('vigencia')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Actualizar
        </button>

        <a href="{{ route('inf_credito.index') }}">
            Cancelar
        </a>

    </form>

</body>

</html>