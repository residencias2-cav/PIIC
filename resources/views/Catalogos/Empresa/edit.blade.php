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
                    value="{{ old('rfc', $empresa->rfc) }}"
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
                            value="{{ old('ciudad', $ciudad) }}"
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
                            value="{{ old('calle', $calle) }}"
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
                            value="{{ old('cp', $cp) }}"
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


            {{-- Acciones --}}
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