
<section
    id="seccion-epp-ni"
    class="formulario-seccion detalle-epp"
    style="display: none;"
>
    <h2 class="formulario-seccion-titulo">
        Detalle EPP NI
    </h2>

    <div class="formulario-grid">

        {{-- Trabajador --}}
        <div class="campo">
            <label for="ni_trabajador_id">Trabajador</label>

            <select id="ni_trabajador_id">
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

        {{-- Artículo --}}
        <div class="campo">
            <label for="ni_articulo_id">Artículo</label>

            <select id="ni_articulo_id">
                <option value="">Selecciona un artículo</option>

                @foreach ($articulos as $articulo)
                    <option value="{{ $articulo->id }}">
                        {{ $articulo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Superintendencia --}}
        <div class="campo">
            <label for="ni_sup_int">sup_int</label>

            <select id="ni_sup_int">
                <option value="">Selecciona una opción</option>
                <option value="superficie">Superficie</option>
                <option value="interior_mina">Interior mina</option>
            </select>
        </div>

    </div>

    <div class="formulario-acciones">
        <button type="button" id="agregar-ni">
            Agregar
        </button>
    </div>

    {{-- Tabla de elementos agregados --}}
    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>Artículo</th>
                    <th>sup_int</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="lista-elementos-ni">
                <tr id="fila-vacia-ni">
                    <td colspan="4">
                        No hay elementos agregados.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Campos ocultos para enviar los datos --}}
    <div id="inputs-ocultos-ni"></div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const trabajador = document.getElementById('ni_trabajador_id');
    const articulo = document.getElementById('ni_articulo_id');
    const supInt = document.getElementById('ni_sup_int');

    const botonAgregar = document.getElementById('agregar-ni');
    const lista = document.getElementById('lista-elementos-ni');
    const inputsOcultos = document.getElementById('inputs-ocultos-ni');

    let indexNi = 0;

    function limpiarCampos() {
        trabajador.value = '';
        articulo.value = '';
        supInt.value = '';
    }

    function actualizarTabla() {
        const filas = lista.querySelectorAll('tr:not(#fila-vacia-ni)');

        const filaVacia = document.getElementById('fila-vacia-ni');

        if (filaVacia) {
            filaVacia.style.display = filas.length === 0 ? '' : 'none';
        }
    }

    botonAgregar.addEventListener('click', function () {

        if (!trabajador.value || !articulo.value || !supInt.value) {
            alert('Completa todos los campos del formulario NI.');
            return;
        }

        const trabajadorTexto =
            trabajador.options[trabajador.selectedIndex].text.trim();

        const articuloTexto =
            articulo.options[articulo.selectedIndex].text.trim();

        const supIntTexto =
            supInt.options[supInt.selectedIndex].text;

        const filaVacia = document.getElementById('fila-vacia-ni');

        if (filaVacia) {
            filaVacia.style.display = 'none';
        }

        const fila = document.createElement('tr');

        fila.innerHTML = `
            <td>${escaparHtml(trabajadorTexto)}</td>
            <td>${escaparHtml(articuloTexto)}</td>
            <td>${escaparHtml(supIntTexto)}</td>
            <td>
                <button type="button" class="eliminar-ni">
                    Eliminar
                </button>
            </td>
        `;

        lista.appendChild(fila);

        const contenedor = document.createElement('div');
        contenedor.dataset.index = indexNi;

        contenedor.innerHTML = `
            <input type="hidden"
                name="detalles_ni[${indexNi}][trabajador_id]"
                value="${escaparAtributo(trabajador.value)}">

            <input type="hidden"
                name="detalles_ni[${indexNi}][articulo_id]"
                value="${escaparAtributo(articulo.value)}">

            <input type="hidden"
                name="detalles_ni[${indexNi}][sup_int]"
                value="${escaparAtributo(supInt.value)}">
        `;

        inputsOcultos.appendChild(contenedor);

        limpiarCampos();

        indexNi++;
    });

    lista.addEventListener('click', function (event) {

        if (event.target.classList.contains('eliminar-ni')) {

            const fila = event.target.closest('tr');
            const filas = Array.from(lista.querySelectorAll('tr:not(#fila-vacia-ni)'));
            const posicion = filas.indexOf(fila);

            const contenedores = Array.from(inputsOcultos.children);

            if (posicion !== -1 && contenedores[posicion]) {
                contenedores[posicion].remove();
            }

            fila.remove();

            actualizarTabla();
        }

    });

    function escaparHtml(texto) {
        return String(texto).replace(/[&<>"']/g, function (caracter) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[caracter];
        });
    }

    function escaparAtributo(texto) {
        return escaparHtml(texto);
    }

    actualizarTabla();

});
</script>
