<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva Obra</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Registrar Obra
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información de la nueva obra.
                </p>
            </div>

        </header>

        {{-- Formulario --}}
        <form
            action="{{ route('obra.store') }}"
            method="POST"
        >

            @csrf

            {{-- Nombre de la obra --}}
            <div class="campo">

                <label for="nombre_obra">
                    Nombre de la obra
                </label>

                <input
                    type="text"
                    id="nombre_obra"
                    name="nombre_obra"
                    value="{{ old('nombre_obra') }}"
                    placeholder="Ejemplo: Proyecto San Julián"
                    maxlength="100"
                    required
                    autofocus
                >

                @error('nombre_obra')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Acciones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('obra.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar obra
                </button>

            </div>

        </form>

    </main>

</body>

</html>