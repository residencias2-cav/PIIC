<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva autorización</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>

        <h1 class="formulario-titulo">Nueva autorización de EPP</h1>

        <p class="formulario-descripcion">
            Registra la autorización de un proceso relacionado con EPP.
        </p>
    </header>

    @if($errors->any())
        <div class="mensaje-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autorizado_por.store') }}" method="POST">
        @csrf

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información de autorización
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="trabajador_id">Trabajador</label>

                    <select name="trabajador_id" id="trabajador_id" required>
                        <option value="">Selecciona un trabajador</option>

                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->id }}"
                                {{ old('trabajador_id') == $trabajador->id ? 'selected' : '' }}>

                                {{ $trabajador->nombre }}
                                {{ $trabajador->apellido_paterno }}
                                {{ $trabajador->apellido_materno }}

                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="epp_id">EPP</label>

                    <select name="epp_id" id="epp_id" required>
                        <option value="">Selecciona un EPP</option>

                        @foreach($epps as $epp)
                            <option value="{{ $epp->id }}"
                                {{ old('epp_id') == $epp->id ? 'selected' : '' }}>

                                {{ $epp->folio }}

                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="proceso_autorizado">
                        ¿Proceso autorizado?
                    </label>

                    <select name="proceso_autorizado"
                            id="proceso_autorizado"
                            required>

                        <option value="">Selecciona una opción</option>

                        <option value="1"
                            {{ old('proceso_autorizado') === '1' ? 'selected' : '' }}>
                            Sí
                        </option>

                        <option value="0"
                            {{ old('proceso_autorizado') === '0' ? 'selected' : '' }}>
                            No
                        </option>

                    </select>
                </div>

                <div class="campo">
                    <label for="fecha_autorizacion">
                        Fecha de autorización
                    </label>

                    <input
                        type="date"
                        name="fecha_autorizacion"
                        id="fecha_autorizacion"
                        value="{{ old('fecha_autorizacion') }}"
                        required>
                </div>

                <div class="campo">
                    <label for="observaciones">Observaciones</label>

                    <textarea
                        name="observaciones"
                        id="observaciones"
                        maxlength="100"
                        rows="3"
                        required>{{ old('observaciones') }}</textarea>
                </div>

            </div>

        </section>

        <div class="formulario-acciones">

            <a href="{{ route('autorizado_por.index') }}"
               class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Guardar autorización
            </button>

        </div>

    </form>

</main>

</body>
</html>