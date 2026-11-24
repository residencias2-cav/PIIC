<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar datos del proveedor</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <!-- ENCABEZADO -->
    <header class="formulario-header">

        <div class="catalogo-linea"></div>

        <div>
            <h1 class="formulario-titulo">
                Registrar datos del proveedor
            </h1>

            <p class="formulario-descripcion">
                Ingresa la información correspondiente al proveedor.
            </p>
        </div>

    </header>

    <!-- ERRORES -->
    @if($errors->any())
        <div class="mensaje-error">
            <strong>Verifica los siguientes errores:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('datos_proveedor.store') }}" method="POST">
        @csrf

        <!-- INFORMACIÓN GENERAL -->
        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información general
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="proveedor_id">Proveedor</label>

                    <select name="proveedor_id" id="proveedor_id" required>
                        <option value="">Selecciona un proveedor</option>

                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="empresa_id">Empresa</label>

                    <select name="empresa_id" id="empresa_id" required>
                        <option value="">Selecciona una empresa</option>

                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}"
                                {{ old('empresa_id') == $empresa->id ? 'selected' : '' }}>
                                {{ $empresa->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="folio">Folio</label>

                    <input type="text"
                           name="folio"
                           id="folio"
                           maxlength="11"
                           value="{{ old('folio') }}"
                           placeholder="Ingresa el folio"
                           required>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>

                    <input type="date"
                           name="fecha"
                           id="fecha"
                           value="{{ old('fecha') }}"
                           required>
                </div>

                <div class="campo">
                    <label for="tiempo_entrega">Tiempo de entrega</label>

                    <input type="text"
                           name="tiempo_entrega"
                           id="tiempo_entrega"
                           maxlength="50"
                           value="{{ old('tiempo_entrega') }}"
                           placeholder="Ingresa el tiempo de entrega"
                           required>
                </div>

                <div class="campo">
                    <label for="metodo_entrega">Método de entrega</label>

                    <input type="text"
                           name="metodo_entrega"
                           id="metodo_entrega"
                           maxlength="50"
                           value="{{ old('metodo_entrega') }}"
                           placeholder="Ingresa el método de entrega"
                           required>
                </div>

            </div>

        </section>

        <!-- INFORMACIÓN DE CONTACTO -->
        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información de contacto
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="correo">Correo electrónico</label>

                    <input type="email"
                           name="correo"
                           id="correo"
                           maxlength="50"
                           value="{{ old('correo') }}"
                           placeholder="ejemplo@correo.com"
                           required>
                </div>

                <div class="campo">
                    <label for="telefono">Teléfono</label>

                    <input type="text"
                           name="telefono"
                           id="telefono"
                           maxlength="20"
                           value="{{ old('telefono') }}"
                           placeholder="Ingresa el teléfono"
                           required>
                </div>

                <div class="campo">
                    <label for="tipo_contrato">Tipo de contrato</label>

                    <input type="text"
                           name="tipo_contrato"
                           id="tipo_contrato"
                           maxlength="50"
                           value="{{ old('tipo_contrato') }}"
                           placeholder="Ingresa el tipo de contrato"
                           required>
                </div>

                <div class="campo">
                    <label for="direccion">Dirección</label>

                    <textarea name="direccion"
                              id="direccion"
                              rows="3"
                              placeholder="Ingresa la dirección"
                              required>{{ old('direccion') }}</textarea>
                </div>

                <div class="campo">
                    <label for="observaciones">Observaciones</label>

                    <textarea name="observaciones"
                              id="observaciones"
                              rows="3"
                              maxlength="100"
                              placeholder="Ingresa las observaciones"
                              required>{{ old('observaciones') }}</textarea>
                </div>

            </div>

        </section>

        <!-- BOTONES -->
        <div class="formulario-acciones">

            <a href="{{ route('datos_proveedor.index') }}"
               class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Guardar datos
            </button>

        </div>

    </form>

</main>

</body>
</html>