<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar gerencia</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar Gerencia
                </h1>

                <p class="formulario-descripcion">
                    Modifica la información de la gerencia seleccionada.
                </p>
            </div>

        </header>


        <form
            action="{{ route('gerencia.update', $gerencia) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="campo">

                <label for="nombre">
                    Nombre de la gerencia
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $gerencia->nombre) }}"
                    maxlength="50"
                    required
                    autofocus
                >

                @error('nombre')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="campo">

                <label for="code">
                    Código
                </label>

                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code', $gerencia->code) }}"
                    maxlength="50"
                    required
                >

                @error('code')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="formulario-acciones">

                <a
                    href="{{ route('gerencia.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar gerencia
                </button>

            </div>

        </form>

    </main>

</body>

</html>