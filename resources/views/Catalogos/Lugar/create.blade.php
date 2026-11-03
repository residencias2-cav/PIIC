<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo Lugar</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Registrar Lugar
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información del nuevo lugar.
                </p>
            </div>

        </header>

        {{-- Formulario --}}
        <form
            action="{{ route('lugar.store') }}"
            method="POST"
        >

            @csrf

            {{-- Nombre del municipio --}}
            <div class="campo">

                <label for="nombre_municipio">
                    Nombre del Municipio
                </label>

                <input
                    type="text"
                    id="nombre_municipio"
                    name="nombre_municipio"
                    value="{{ old('nombre_municipio') }}"
                    placeholder="Ejemplo: Sombrerete"
                    maxlength="100"
                    required
                    autofocus
                >

                @error('nombre_municipio')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Acciones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('lugar.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar lugar
                </button>

            </div>

        </form>

    </main>

</body>

</html>