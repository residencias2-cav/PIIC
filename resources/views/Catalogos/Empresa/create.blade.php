<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva empresa</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Registrar Empresa
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información de la nueva empresa.
                </p>
            </div>

        </header>


        <form
            action="{{ route('empresa.store') }}"
            method="POST"
        >

            @csrf


            {{-- Nombre --}}
            <div class="campo">

                <label for="nombre">
                    Nombre de la empresa
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    autofocus
                >

                @error('nombre')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- RFC --}}
            <div class="campo">

                <label for="rfc">
                    RFC
                </label>

                <input
                    type="text"
                    id="rfc"
                    name="rfc"
                    value="{{ old('rfc') }}"
                    maxlength="13"
                    required
                >

                @error('rfc')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Domicilio fiscal --}}
            <div class="campo">

                <label>
                    Domicilio fiscal
                </label>

                <div class="domicilio-fiscal">

                    <div>

                        <label for="ciudad">
                            Ciudad
                        </label>

                        <input
                            type="text"
                            id="ciudad"
                            name="ciudad"
                            value="{{ old('ciudad') }}"
                            required
                        >

                        @error('ciudad')
                            <p class="mensaje-error">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="calle">
                            Calle
                        </label>

                        <input
                            type="text"
                            id="calle"
                            name="calle"
                            value="{{ old('calle') }}"
                            required
                        >

                        @error('calle')
                            <p class="mensaje-error">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="cp">
                            Código postal
                        </label>

                        <input
                            type="text"
                            id="cp"
                            name="cp"
                            value="{{ old('cp') }}"
                            maxlength="5"
                            inputmode="numeric"
                            required
                        >

                        @error('cp')
                            <p class="mensaje-error">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


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
                    Guardar empresa
                </button>

            </div>

        </form>

    </main>

</body>

</html>