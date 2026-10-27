<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo contrato</title>
</head>

<body>

    <h1>Registrar Información de Contrato</h1>

    <form action="{{ route('inf_contrato.store') }}" method="POST">

        @csrf

        <div>
            <label for="tipo_contrato">
                Tipo de contrato:
            </label>

            <input
                type="text"
                id="tipo_contrato"
                name="tipo_contrato"
                value="{{ old('tipo_contrato') }}"
                required
            >

            @error('tipo_contrato')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="vigencia">
                Vigencia:
            </label>

            <input
                type="date"
                id="vigencia"
                name="vigencia"
                value="{{ old('vigencia') }}"
                required
            >

            @error('vigencia')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Guardar
        </button>

        <a href="{{ route('inf_contrato.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>