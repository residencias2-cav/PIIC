<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar trabajador</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

    <main class="formulario-card">

        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>

                <h1 class="formulario-titulo">
                    Registrar trabajador
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información personal
                    e identificativa del trabajador.
                </p>

            </div>

        </header>


        @if ($errors->any())

            <div class="mensaje-error">

                <strong>
                    Revisa la información:
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('trabajador.store') }}"
            method="POST"
        >

            @csrf


            {{-- Información personal --}}
            <section class="formulario-seccion">

                <h2 class="formulario-seccion-titulo">
                    Información personal
                </h2>


                <div class="campo">

                    <label for="nt">
                        NT
                    </label>

                    <input
                        type="text"
                        id="nt"
                        name="nt"
                        value="{{ old('nt') }}"
                        required
                    >

                    @error('nt')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="campo">

                    <label for="nombre">
                        Nombre
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        required
                    >

                    @error('nombre')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="formulario-grid">

                    <div class="campo">

                        <label for="apellido_paterno">
                            Apellido paterno
                        </label>

                        <input
                            type="text"
                            id="apellido_paterno"
                            name="apellido_paterno"
                            value="{{ old('apellido_paterno') }}"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="apellido_materno">
                            Apellido materno
                        </label>

                        <input
                            type="text"
                            id="apellido_materno"
                            name="apellido_materno"
                            value="{{ old('apellido_materno') }}"
                            required
                        >

                    </div>

                </div>


                <div class="formulario-grid">

                    <div class="campo">

                        <label for="sexo">
                            Sexo
                        </label>

                        <select
                            id="sexo"
                            name="sexo"
                            required
                        >

                            <option value="">
                                Selecciona una opción
                            </option>

                            @foreach (\App\Enums\Sexo::cases() as $sexo)

                                <option
                                    value="{{ $sexo->value }}"
                                    @selected(old('sexo') === $sexo->value)
                                >
                                    {{ $sexo->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="campo">

                        <label for="fecha_nacimiento">
                            Fecha de nacimiento
                        </label>

                        <input
                            type="date"
                            id="fecha_nacimiento"
                            name="fecha_nacimiento"
                            value="{{ old('fecha_nacimiento') }}"
                            required
                        >

                    </div>

                </div>

            </section>


            {{-- Identificación --}}
            <section class="formulario-seccion">

                <h2 class="formulario-seccion-titulo">
                    Identificación
                </h2>


                <div class="campo">

                    <label for="nss">
                        NSS
                    </label>

                    <input
                        type="text"
                        id="nss"
                        name="nss"
                        value="{{ old('nss') }}"
                        required
                    >

                </div>


                <div class="campo">

                    <label for="curp">
                        CURP
                    </label>

                    <input
                        type="text"
                        id="curp"
                        name="curp"
                        value="{{ old('curp') }}"
                        required
                    >

                </div>


                <div class="campo">

                    <label for="rfc">
                        RFC
                    </label>

                    <input
                        type="text"
                        id="rfc"
                        name="rfc"
                        value="{{ old('rfc') }}"
                        required
                    >

                </div>

            </section>


            {{-- Información adicional --}}
            <section class="formulario-seccion">

                <h2 class="formulario-seccion-titulo">
                    Información adicional
                </h2>


                <div class="formulario-grid">

                    <div class="campo">

                        <label for="lugar_nacimiento_id">
                            Lugar de nacimiento
                        </label>

                        <select
                            id="lugar_nacimiento_id"
                            name="lugar_nacimiento_id"
                            required
                        >

                            <option value="">
                                Selecciona un lugar
                            </option>

                            @foreach ($lugaresNacimiento as $lugar)

                                <option
                                    value="{{ $lugar->id }}"
                                    @selected(
                                        old('lugar_nacimiento_id') == $lugar->id
                                    )
                                >
                                    {{ $lugar->nombre }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="campo">

                        <label for="tipo_sangre_id">
                            Tipo de sangre
                        </label>

                        <select
                            id="tipo_sangre_id"
                            name="tipo_sangre_id"
                            required
                        >

                            <option value="">
                                Selecciona un tipo de sangre
                            </option>

                            @foreach ($tiposSangre as $tipoSangre)

                                <option
                                    value="{{ $tipoSangre->id }}"
                                    @selected(
                                        old('tipo_sangre_id') == $tipoSangre->id
                                    )
                                >
                                    {{ $tipoSangre->nombre }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </section>


            <div class="formulario-acciones">

                <a
                    href="{{ route('trabajador.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar trabajador
                </button>

            </div>

        </form>

    </main>

</body>

</html>