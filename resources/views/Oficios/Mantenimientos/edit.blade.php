<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar mantenimiento</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>
        <div>
            <h1 class="formulario-titulo">Editar mantenimiento</h1>
            <p class="formulario-descripcion">
                Modifica la información del mantenimiento seleccionado.
            </p>
        </div>
    </header>

    <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">
                Información general
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="pedido_id">Pedido</label>

                    <select name="pedido_id" id="pedido_id" required>
                        <option value="">Selecciona un pedido</option>

                        @foreach($pedidos as $pedido)
                            <option value="{{ $pedido->id }}"
                                {{ old('pedido_id', $mantenimiento->pedido_id) == $pedido->id ? 'selected' : '' }}>
                                {{ $pedido->folio }}
                            </option>
                        @endforeach
                    </select>

                    @error('pedido_id')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>

                    <input type="date"
                           name="fecha"
                           id="fecha"
                           value="{{ old('fecha', $mantenimiento->fecha?->format('Y-m-d')) }}"
                           required>

                    @error('fecha')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="trabajador_id">Trabajador</label>

                    <select name="trabajador_id" id="trabajador_id" required>
                        <option value="">Selecciona un trabajador</option>

                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->id }}"
                                {{ old('trabajador_id', $mantenimiento->trabajador_id) == $trabajador->id ? 'selected' : '' }}>
                                {{ $trabajador->nombre }}
                                {{ $trabajador->apellido_paterno }}
                                {{ $trabajador->apellido_materno }}
                            </option>
                        @endforeach
                    </select>

                    @error('trabajador_id')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="gerencia_id">Gerencia</label>

                    <select name="gerencia_id" id="gerencia_id" required>
                        <option value="">Selecciona una gerencia</option>

                        @foreach($gerencias as $gerencia)
                            <option value="{{ $gerencia->id }}"
                                {{ old('gerencia_id', $mantenimiento->gerencia_id) == $gerencia->id ? 'selected' : '' }}>
                                {{ $gerencia->code }}
                            </option>
                        @endforeach
                    </select>

                    @error('gerencia_id')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="folio">Folio del mantenimiento</label>

                    <input type="text"
                           name="folio"
                           id="folio"
                           maxlength="20"
                           value="{{ old('folio', $mantenimiento->folio) }}"
                           required>

                    @error('folio')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="lugar">Lugar</label>

                    <input type="text"
                           name="lugar"
                           id="lugar"
                           maxlength="150"
                           value="{{ old('lugar', $mantenimiento->lugar) }}"
                           required>

                    @error('lugar')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="descripcion">Descripción</label>

                    <input type="text"
                           name="descripcion"
                           id="descripcion"
                           maxlength="150"
                           value="{{ old('descripcion', $mantenimiento->descripcion) }}"
                           required>

                    @error('descripcion')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="autorizado_por_id">Autorizado por</label>

                    <select name="autorizado_por_id" id="autorizado_por_id" required>
                        <option value="">Selecciona una autorización</option>

                        @foreach($autorizados as $autorizado)
                            <option value="{{ $autorizado->id }}"
                                {{ old('autorizado_por_id', $mantenimiento->autorizado_por_id) == $autorizado->id ? 'selected' : '' }}>

                                Autorización #{{ $autorizado->id }}

                                @if($autorizado->trabajador)
                                    - {{ $autorizado->trabajador->nombre }}
                                    {{ $autorizado->trabajador->apellido_paterno }}
                                    {{ $autorizado->trabajador->apellido_materno }}
                                @endif

                                @if($autorizado->epp)
                                    - EPP: {{ $autorizado->epp->folio }}
                                @endif

                            </option>
                        @endforeach
                    </select>

                    @error('autorizado_por_id')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </section>

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">
                Material y surtido
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="material_necesario">Material necesario</label>

                    <textarea name="material_necesario"
                              id="material_necesario"
                              rows="4"
                              required>{{ old('material_necesario', $mantenimiento->material_necesario) }}</textarea>

                    @error('material_necesario')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="surtido">¿Material surtido?</label>

                    <select name="surtido" id="surtido" required>
                        <option value="">Selecciona una opción</option>

                        <option value="1"
                            {{ old('surtido', (string) $mantenimiento->surtido) === '1' ? 'selected' : '' }}>
                            Sí
                        </option>

                        <option value="0"
                            {{ old('surtido', (string) $mantenimiento->surtido) === '0' ? 'selected' : '' }}>
                            No
                        </option>
                    </select>

                    @error('surtido')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </section>

        <div class="formulario-acciones">
            <a href="{{ route('mantenimientos.index') }}" class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Actualizar mantenimiento
            </button>
        </div>

    </form>

</main>

</body>
</html>