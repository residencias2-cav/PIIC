<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar empresa</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar Empresa
                </h1>

                <p class="formulario-descripcion">
                    Modifica la información de la empresa seleccionada.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('empresa.update', $empresa) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Nombre --}}
            <div class="campo">

                <label for="nombre">
                    Nombre de la empresa
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $empresa->nombre) }}"
                    maxlength="255"
                    required
                    autofocus
                >

                @error('nombre')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Botones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('empresa.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar empresa
                </button>

            </div>

        </form>

    </main>

</body>

</html>