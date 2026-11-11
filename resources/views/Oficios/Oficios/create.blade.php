<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar oficio</title>

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
                Registrar oficio
            </h1>

            <p class="formulario-descripcion">
                Ingresa la información general del oficio.
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
        action="{{ route('oficio.store') }}"
        method="POST"
    >

        @csrf


        {{-- IDENTIFICACIÓN --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Identificación
            </h2>


            <div class="formulario-grid">

                <div class="campo campo-bloqueado">

                    <label for="fecha_visual">
                        Fecha
                    </label>

                    <input
                        type="date"
                        id="fecha_visual"
                        value="{{ now()->toDateString() }}"
                        readonly
                    >

                    <p class="campo-ayuda">
                        Se asigna automáticamente.
                    </p>

                </div>


                <div class="campo campo-bloqueado">

                    <label for="folio_visual">
                        Folio
                    </label>

                    <input
                        type="text"
                        id="folio_visual"
                        value="{{ $siguienteFolio }}"
                        readonly
                    >

                    <p class="campo-ayuda">
                        Se genera automáticamente.
                    </p>

                </div>

            </div>

        </section>


        {{-- CLASIFICACIÓN --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Clasificación
            </h2>


            <div class="formulario-grid">

                <div class="campo">

                    <label for="tipo_oficio_id">
                        Tipo de oficio
                    </label>

                    <select
                        id="tipo_oficio_id"
                        name="tipo_oficio_id"
                        required
                    >

                        <option value="">
                            Selecciona un tipo
                        </option>

                        @foreach ($tiposOficio as $tipoOficio)

                            <option
                                value="{{ $tipoOficio->id }}"
                                @selected(
                                    old('tipo_oficio_id') == $tipoOficio->id
                                )
                            >
                                {{ $tipoOficio->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="campo">

                    <label for="estado_id">
                        Estado
                    </label>

                    <select
                        id="estado_id"
                        name="estado_id"
                        required
                    >

                        <option value="">
                            Selecciona un estado
                        </option>

                        @foreach ($estados as $estado)

                            <option
                                value="{{ $estado->id }}"
                                @selected(
                                    old('estado_id') == $estado->id
                                )
                            >
                                {{ $estado->nombre_estado }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </section>


        {{-- CONTENIDO --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Contenido
            </h2>


            <div class="campo">

                <label for="asunto">
                    Asunto
                </label>

                <input
                    type="text"
                    id="asunto"
                    name="asunto"
                    value="{{ old('asunto') }}"
                    placeholder="Asunto del oficio"
                    required
                >

            </div>


            <div class="campo">

                <label for="cuerpo">
                    Cuerpo del oficio
                </label>

                <textarea
                    id="cuerpo"
                    name="cuerpo"
                    rows="8"
                    placeholder="Contenido del oficio"
                    required
                >{{ old('cuerpo') }}</textarea>

            </div>

        </section>


        {{-- INFORMACIÓN ADICIONAL --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información adicional
            </h2>


            <div class="campo">

                <label for="observaciones">
                    Observaciones
                </label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    rows="3"
                    placeholder="Observaciones"
                >{{ old('observaciones') }}</textarea>

            </div>


            <div class="campo">

                <label for="cargos_generales">
                    Cargos generales
                </label>

                <textarea
                    id="cargos_generales"
                    name="cargos_generales"
                    rows="3"
                    placeholder="Cargos generales"
                >{{ old('cargos_generales') }}</textarea>

            </div>

        </section>


        {{-- 
            NIVEL 3

            Posteriormente podremos agregar aquí:

            @includeIf('Oficios.OficiosProductos._form')
            @includeIf('Oficios.OficiosRepse._form')
            @includeIf('Oficios.OficiosRutas._form')
            @includeIf('Oficios.OficiosComisiones._form')
            @includeIf('Oficios.Destinatarios._form')
        --}}


        <div class="formulario-acciones">

            <a
                href="{{ route('oficio.index') }}"
                class="btn btn-secundario"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-principal"
            >
                Guardar oficio
            </button>

        </div>

    </form>

</main>

</body>

</html>