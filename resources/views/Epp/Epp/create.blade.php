<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nueva solicitud EPP</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Registrar solicitud EPP
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información general de la solicitud.
                </p>
            </div>

        </header>


        <form
            action="{{ route('epp.store') }}"
            method="POST"
        >

            @csrf


            {{-- Fecha --}}
            <div class="campo">

                <label for="fecha_visual">
                    Fecha
                </label>

                <input
                    type="date"
                    id="fecha_visual"
                    value="{{ now()->toDateString() }}"
                    readonly
                >

            </div>


            {{-- Folio --}}
            <div class="campo">

                <label for="folio_visual">
                    Folio
                </label>

                <input
                    type="text"
                    id="folio_visual"
                    value="{{ $siguienteFolio }}"
                    readonly
                >

            </div>


            {{-- Tipo EPP --}}
            <div class="campo">

                <label for="tipo_epp_id">
                    Tipo de EPP
                </label>

                <select
                    id="tipo_epp_id"
                    name="tipo_epp_id"
                    required
                >

                    <option value="">
                        Selecciona un tipo
                    </option>

                    @foreach ($tiposEpp as $tipoEpp)

                        <option
                            value="{{ $tipoEpp->id }}"
                            @selected(
                                old('tipo_epp_id') == $tipoEpp->id
                            )
                        >
                            {{ $tipoEpp->nombre }}
                        </option>

                    @endforeach

                </select>

                @error('tipo_epp_id')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Obra --}}
            <div class="campo">

                <label for="obra_id">
                    Obra
                </label>

                <select
                    id="obra_id"
                    name="obra_id"
                    required
                >

                    <option value="">
                        Selecciona una obra
                    </option>

                    @foreach ($obras as $obra)

                        <option
                            value="{{ $obra->id }}"
                            @selected(
                                old('obra_id') == $obra->id
                            )
                        >
                            {{ $obra->nombre_obra }}
                        </option>

                    @endforeach

                </select>

                @error('obra_id')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Empresa --}}
            <div class="campo">

                <label for="empresa_id">
                    Empresa
                </label>

                <select
                    id="empresa_id"
                    name="empresa_id"
                    required
                >

                    <option value="">
                        Selecciona una empresa
                    </option>

                    @foreach ($empresas as $empresa)

                        <option
                            value="{{ $empresa->id }}"
                            @selected(
                                old('empresa_id') == $empresa->id
                            )
                        >
                            {{ $empresa->nombre }}
                        </option>

                    @endforeach

                </select>

                @error('empresa_id')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Motivo --}}
            <div class="campo">

                <label for="motivo">
                    Motivo
                </label>

                <input
                    type="text"
                    id="motivo"
                    name="motivo"
                    value="{{ old('motivo') }}"
                    placeholder="Motivo de la solicitud"
                    maxlength="150"
                    required
                >

                @error('motivo')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Justificación --}}
            <div class="campo">

                <label for="justificacion">
                    Justificación
                </label>

                <textarea
                    id="justificacion"
                    name="justificacion"
                    rows="4"
                    maxlength="100"
                    placeholder="Describe la justificación de la solicitud"
                    required
                >{{ old('justificacion') }}</textarea>

                @error('justificacion')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Logística --}}
            <div class="campo">

                <label for="logistica">
                    Logística
                </label>

                <textarea
                    id="logistica"
                    name="logistica"
                    rows="3"
                    maxlength="100"
                    placeholder="Información de logística"
                    required
                >{{ old('logistica') }}</textarea>

                @error('logistica')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Acciones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('epp.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar solicitud
                </button>

            </div>

        </form>

    </main>

</body>

</html>