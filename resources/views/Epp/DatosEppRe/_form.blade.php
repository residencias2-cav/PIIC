
<section
    id="seccion-epp-re"
    class="formulario-seccion detalle-epp"
    style="display: none;"
>
    <h2 class="formulario-seccion-titulo">
        Detalle EPP RE
    </h2>

    <div class="formulario-grid">

        <div class="campo">
            <label for="re_trabajador_id">Trabajador</label>
            <select id="re_trabajador_id">
                <option value="">Selecciona un trabajador</option>
                @foreach ($trabajadores as $trabajador)
                    <option value="{{ $trabajador->id }}">
                        {{ $trabajador->nombre }}
                        {{ $trabajador->apellido_paterno }}
                        {{ $trabajador->apellido_materno }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="re_fecha_ingreso">Fecha de ingreso</label>
            <input type="date" id="re_fecha_ingreso">
        </div>

        <div class="campo">
            <label for="re_motivo">Motivo</label>
            <input type="text" id="re_motivo" maxlength="100">
        </div>

        <div class="campo">
            <label for="re_articulo_id">Artículo</label>
            <select id="re_articulo_id">
                <option value="">Selecciona un artículo</option>
                @foreach ($articulos as $articulo)
                    <option value="{{ $articulo->id }}">
                        {{ $articulo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="re_fecha_entrega">Fecha de entrega</label>
            <input type="date" id="re_fecha_entrega">
        </div>

        <div class="campo">
            <label for="re_foto_evidencia">Foto de evidencia</label>
            <input
                type="file"
                id="re_foto_evidencia"
                accept="image/*"
            >
        </div>

        <div class="campo">
            <label for="re_observaciones">Observaciones</label>
            <textarea
                id="re_observaciones"
                maxlength="100"
            ></textarea>
        </div>

        <div class="campo">
            <label for="re_talla">Talla</label>
            <input
                type="number"
                id="re_talla"
                min="1"
                step="1"
            >
        </div>

        <div class="campo">
            <label for="re_estado_id">Estado</label>
            <select id="re_estado_id">
                <option value="">Selecciona un estado</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre_estado }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="re_fecha_estado">Fecha de estado</label>
            <input type="date" id="re_fecha_estado">
        </div>

    </div>

    <div class="formulario-acciones">
        <button type="button" id="agregar-re">
            Agregar
        </button>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>Artículo</th>
                    <th>Motivo</th>
                    <th>Fecha de entrega</th>
                    <th>Foto</th>
                    <th>Talla</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="lista-elementos-re">
                <tr id="fila-vacia-re">
                    <td colspan="8">No hay elementos agregados.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="inputs-ocultos-re"></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const trabajador = document.getElementById('re_trabajador_id');
    const fechaIngreso = document.getElementById('re_fecha_ingreso');
    const motivo = document.getElementById('re_motivo');
    const articulo = document.getElementById('re_articulo_id');
    const fechaEntrega = document.getElementById('re_fecha_entrega');
    const foto = document.getElementById('re_foto_evidencia');
    const observaciones = document.getElementById('re_observaciones');
    const talla = document.getElementById('re_talla');
    const estado = document.getElementById('re_estado_id');
    const fechaEstado = document.getElementById('re_fecha_estado');

    const botonAgregar = document.getElementById('agregar-re');
    const lista = document.getElementById('lista-elementos-re');
    const inputsOcultos = document.getElementById('inputs-ocultos-re');

    let indexRe = 0;

    function limpiarCampos() {
        trabajador.value = '';
        fechaIngreso.value = '';
        motivo.value = '';
        articulo.value = '';
        fechaEntrega.value = '';
        observaciones.value = '';
        talla.value = '';
        estado.value = '';
        fechaEstado.value = '';
    }

    function actualizarTabla() {
        const filas = lista.querySelectorAll('tr:not(#fila-vacia-re)');
        const filaVacia = document.getElementById('fila-vacia-re');

        if (filaVacia) {
            filaVacia.style.display = filas.length === 0 ? '' : 'none';
        }
    }

    botonAgregar.addEventListener('click', function () {

        if (
            !trabajador.value ||
            !fechaIngreso.value ||
            !motivo.value.trim() ||
            !articulo.value ||
            !fechaEntrega.value ||
            !foto.files.length ||
            !observaciones.value.trim() ||
            !talla.value ||
            !estado.value ||
            !fechaEstado.value
        ) {
            alert('Completa todos los campos del formulario RE.');
            return;
        }

        if (!Number.isInteger(Number(talla.value)) || Number(talla.value) < 1) {
            alert('La talla debe ser un número entero mayor que cero.');
            return;
        }

        const archivo = foto.files[0];

        if (!archivo.type.startsWith('image/')) {
            alert('Selecciona un archivo de imagen válido.');
            return;
        }

        const trabajadorTexto =
            trabajador.options[trabajador.selectedIndex].text.trim();

        const articuloTexto =
            articulo.options[articulo.selectedIndex].text.trim();

        const estadoTexto =
            estado.options[estado.selectedIndex].text.trim();

        const fila = document.createElement('tr');

        const datosVisibles = [
            trabajadorTexto,
            articuloTexto,
            motivo.value.trim(),
            fechaEntrega.value,
            archivo.name,
            talla.value,
            estadoTexto
        ];

        datosVisibles.forEach(function (dato) {
            const celda = document.createElement('td');
            celda.textContent = dato;
            fila.appendChild(celda);
        });

        const celdaAcciones = document.createElement('td');
        const botonEliminar = document.createElement('button');

        botonEliminar.type = 'button';
        botonEliminar.className = 'eliminar-re';
        botonEliminar.textContent = 'Eliminar';

        celdaAcciones.appendChild(botonEliminar);
        fila.appendChild(celdaAcciones);

        lista.appendChild(fila);

        const contenedor = document.createElement('div');
        contenedor.dataset.index = indexRe;

        const campos = {
            trabajador_id: trabajador.value,
            fecha_ingreso: fechaIngreso.value,
            motivo: motivo.value.trim(),
            articulo_id: articulo.value,
            fecha_entrega: fechaEntrega.value,
            observaciones: observaciones.value.trim(),
            talla: talla.value,
            estado_id: estado.value,
            fecha_estado: fechaEstado.value
        };

        Object.entries(campos).forEach(function ([nombre, valor]) {
            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = `detalles_re[${indexRe}][${nombre}]`;
            input.value = valor;

            contenedor.appendChild(input);
        });

        // El archivo se conserva como input real para enviarlo al servidor.
        const fotoGuardada = foto;
        fotoGuardada.name = `detalles_re[${indexRe}][foto_evidencia]`;
        fotoGuardada.style.display = 'none';

        contenedor.appendChild(fotoGuardada);
        inputsOcultos.appendChild(contenedor);

        // Crear un nuevo input para poder seleccionar otra imagen.
        const nuevaFoto = fotoGuardada.cloneNode(true);
        nuevaFoto.value = '';
        nuevaFoto.name = '';
        nuevaFoto.style.display = '';

        fotoGuardada.parentNode.replaceChild(nuevaFoto, fotoGuardada);

        // Actualizar la referencia al nuevo input.
        fotoElement = nuevaFoto;

        limpiarCampos();
        indexRe++;

    });

    lista.addEventListener('click', function (event) {

        if (event.target.classList.contains('eliminar-re')) {

            const fila = event.target.closest('tr');
            const filas = Array.from(
                lista.querySelectorAll('tr:not(#fila-vacia-re)')
            );

            const posicion = filas.indexOf(fila);
            const contenedores = Array.from(inputsOcultos.children);

            if (posicion !== -1 && contenedores[posicion]) {
                contenedores[posicion].remove();
            }

            fila.remove();
            actualizarTabla();
        }
    });

    actualizarTabla();

});
</script>
