<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar proveedor</title>

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
                Registrar proveedor
            </h1>

            <p class="formulario-descripcion">
                Ingresa la información general y administrativa del proveedor.
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
        action="{{ route('proveedor.store') }}"
        method="POST"
    >

        @csrf


        {{-- INFORMACIÓN GENERAL --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información general
            </h2>


            <div class="formulario-grid">

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

                </div>


                <div class="campo">

                    <label for="razon_social">
                        Razón social
                    </label>

                    <input
                        type="text"
                        id="razon_social"
                        name="razon_social"
                        value="{{ old('razon_social') }}"
                        required
                    >

                </div>

            </div>


            <div class="formulario-grid">

                <div class="campo">

                    <label for="curp">
                        CURP
                    </label>

                    <input
                        type="text"
                        id="curp"
                        name="curp"
                        value="{{ old('curp') }}"
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

            </div>


            <div class="campo">

                <label for="area">
                    Área
                </label>

                <input
                    type="text"
                    id="area"
                    name="area"
                    value="{{ old('area') }}"
                    required
                >

            </div>

        </section>


        {{-- INFORMACIÓN COMERCIAL --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información comercial
            </h2>


            <div class="campo">

                <label for="desc_bs">
                    Descripción de bienes o servicios
                </label>

                <textarea
                    id="desc_bs"
                    name="desc_bs"
                    rows="4"
                    required
                >{{ old('desc_bs') }}</textarea>

            </div>


            <div class="campo">

                <label for="vigencia_sat">
                    Vigencia SAT
                </label>

                <input
                    type="date"
                    id="vigencia_sat"
                    name="vigencia_sat"
                    value="{{ old('vigencia_sat') }}"
                    required
                >

            </div>

        </section>


        {{-- INFORMACIÓN ADMINISTRATIVA --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información administrativa
            </h2>


            <div class="formulario-grid">

                {{-- Crédito --}}
                <div class="campo">

                    <label for="inf_credito_id">
                        Información de crédito
                    </label>

                    <select
                        id="inf_credito_id"
                        name="inf_credito_id"
                        required
                    >

                        <option value="">
                            Selecciona información de crédito
                        </option>

                        @foreach ($creditos as $credito)

                            <option
                                value="{{ $credito->id }}"
                                @selected(
                                    old('inf_credito_id') == $credito->id
                                )
                            >
                                ${{ number_format($credito->monto, 2) }}
                                - Vigencia: {{ $credito->vigencia }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Contrato --}}
                <div class="campo">

                    <label for="inf_contrato_id">
                        Información de contrato
                    </label>

                    <select
                        id="inf_contrato_id"
                        name="inf_contrato_id"
                        required
                    >

                        <option value="">
                            Selecciona un contrato
                        </option>

                        @foreach ($contratos as $contrato)

                            <option
                                value="{{ $contrato->id }}"
                                @selected(
                                    old('inf_contrato_id') == $contrato->id
                                )
                            >
                                {{ $contrato->tipo_contrato }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="campo">

                <label for="inf_impuestos">
                    Información de impuestos
                </label>

                <textarea
                    id="inf_impuestos"
                    name="inf_impuestos"
                    rows="3"
                    required
                >{{ old('inf_impuestos') }}</textarea>

            </div>


            <div class="campo">

                <label for="registrado">
                    Registrado
                </label>

                <select
                    id="registrado"
                    name="registrado"
                    required
                >

                    <option value="">
                        Selecciona una opción
                    </option>

                    <option
                        value="1"
                        @selected(old('registrado') === '1')
                    >
                        Sí
                    </option>

                    <option
                        value="0"
                        @selected(old('registrado') === '0')
                    >
                        No
                    </option>

                </select>

            </div>

        </section>


        <div class="formulario-acciones">

            <a
                href="{{ route('proveedor.index') }}"
                class="btn btn-secundario"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-principal"
            >
                Guardar proveedor
            </button>

        </div>

    </form>

</main>

</body>

</html>