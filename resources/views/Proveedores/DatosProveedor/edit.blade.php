<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar datos del proveedor</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">

        <div class="catalogo-linea"></div>

        <div>
            <h1 class="formulario-titulo">
                Editar datos del proveedor
            </h1>

            <p class="formulario-descripcion">
                Modifica la información del proveedor seleccionado.
            </p>
        </div>

    </header>

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

    <form action="{{ route('datos_proveedor.update', $datos_proveedor->id) }}"
          method="POST">

        @csrf
        @method('PUT')

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
                                {{ old('proveedor_id', $datos_proveedor->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
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
                                {{ old('empresa_id', $datos_proveedor->empresa_id) == $empresa->id ? 'selected' : '' }}>
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
                           value="{{ old('folio', $datos_proveedor->folio) }}"
                           required>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>

                    <input type="date"
                           name="fecha"
                           id="fecha"
                           value="{{ old('fecha', $datos_proveedor->fecha?->format('Y-m-d')) }}"
                           required>
                </div>

                <div class="campo">
                    <label for="tiempo_entrega">Tiempo de entrega</label>

                    <input type="text"
                           name="tiempo_entrega"
                           id="tiempo_entrega"
                           maxlength="50"
                           value="{{ old('tiempo_entrega', $datos_proveedor->tiempo_entrega) }}"
                           required>
                </div>

                <div class="campo">
                    <label for="metodo_entrega">Método de entrega</label>

                    <input type="text"
                           name="metodo_entrega"
                           id="metodo_entrega"
                           maxlength="50"
                           value="{{ old('metodo_entrega', $datos_proveedor->metodo_entrega) }}"
                           required>
                </div>

            </div>

        </section>

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
                           value="{{ old('correo', $datos_proveedor->correo) }}"
                           required>
                </div>

                <div class="campo">
                    <label for="telefono">Teléfono</label>

                    <input type="text"
                           name="telefono"
                           id="telefono"
                           maxlength="20"
                           value="{{ old('telefono', $datos_proveedor->telefono) }}"
                           required>
                </div>

                <div class="campo">
                    <label for="tipo_contrato">Tipo de contrato</label>

                    <input type="text"
                           name="tipo_contrato"
                           id="tipo_contrato"
                           maxlength="50"
                           value="{{ old('tipo_contrato', $datos_proveedor->tipo_contrato) }}"
                           required>
                </div>

                <div class="campo">
                    <label for="direccion">Dirección</label>

                    <textarea name="direccion"
                              id="direccion"
                              rows="3"
                              required>{{ old('direccion', $datos_proveedor->direccion) }}</textarea>
                </div>

                <div class="campo">
                    <label for="observaciones">Observaciones</label>

                    <textarea name="observaciones"
                              id="observaciones"
                              rows="3"
                              maxlength="100"
                              required>{{ old('observaciones', $datos_proveedor->observaciones) }}</textarea>
                </div>

            </div>

        </section>

        <div class="formulario-acciones">

            <a href="{{ route('datos_proveedor.index') }}"
               class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Actualizar datos
            </button>

        </div>

    </form>

</main>

</body>
</html>