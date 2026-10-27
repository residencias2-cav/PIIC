<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar empresa</title>
</head>

<body>

    <h1>Editar Empresa</h1>

    <form
        action="{{ route('empresa.update', $empresa) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre:</label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $empresa->nombre) }}"
                required
            >

            @error('nombre')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="rfc">RFC:</label>

            <input
                type="text"
                id="rfc"
                name="rfc"
                value="{{ old('rfc', $empresa->rfc) }}"
                required
            >

            @error('rfc')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="dom_fiscal">Domicilio Fiscal:</label>

            <input
                type="text"
                id="dom_fiscal"
                name="dom_fiscal"
                value="{{ old('dom_fiscal', $empresa->dom_fiscal) }}"
                required
            >

            @error('dom_fiscal')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Actualizar
        </button>

        <a href="{{ route('empresa.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>