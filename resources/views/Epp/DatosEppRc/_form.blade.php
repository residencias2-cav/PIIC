
<section
    id="seccion-epp-rc"
    class="formulario-seccion detalle-epp"
    style="display: none;"
>
    <h2 class="formulario-seccion-titulo">
        Detalle EPP RC
    </h2>

    <div class="formulario-grid">

        <div class="campo">
            <label for="rc_trabajador">Trabajador</label>

            <select id="rc_trabajador">
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
            <label for="rc_articulo">Artículo</label>

            <select id="rc_articulo">
                <option value="">Selecciona un artículo</option>

                @foreach ($articulos as $articulo)
                    <option value="{{ $articulo->id }}">
                        {{ $articulo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="rc_talla">Talla</label>

            <input
                type="text"
                id="rc_talla"
                maxlength="50"
                placeholder="Ej. CH, M, G, EG"
            >
        </div>

    </div>

    <div class="formulario-acciones">
        <button
            type="button"
            id="agregar-rc"
            class="btn btn-principal"
        >
            Agregar
        </button>
    </div>

    <div class="tabla-detalles">
        <table>
            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>Artículo</th>
                    <th>Talla</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tabla-rc"></tbody>
        </table>
    </div>

    <div id="inputs-rc"></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const trabajador = document.getElementById('rc_trabajador');
    const articulo = document.getElementById('rc_articulo');
    const talla = document.getElementById('rc_talla');

    const botonAgregar = document.getElementById('agregar-rc');
    const tabla = document.getElementById('tabla-rc');
    const contenedor = document.getElementById('inputs-rc');

    let indexRc = 0;

    botonAgregar.addEventListener('click', function () {

        if (!trabajador.value || !articulo.value || !talla.value.trim()) {
            alert('Completa todos los campos de EPP RC.');
            return;
        }

        const nombreTrabajador =
            trabajador.options[trabajador.selectedIndex].text.trim();

        const nombreArticulo =
            articulo.options[articulo.selectedIndex].text.trim();

        const fila = document.createElement('tr');

        fila.dataset.index = indexRc;

        fila.innerHTML = `
            <td>${nombreTrabajador}</td>
            <td>${nombreArticulo}</td>
            <td>${talla.value.trim()}</td>
            <td>
                <button
                    type="button"
                    class="btn btn-principal eliminar-rc"
                >
                    Eliminar
                </button>
            </td>
        `;

        const campos = document.createElement('div');
        campos.dataset.index = indexRc;

        campos.innerHTML = `
            <input
                type="hidden"
                name="detalles_rc[${indexRc}][trabajador_id]"
                value="${trabajador.value}"
            >

            <input
                type="hidden"
                name="detalles_rc[${indexRc}][articulo_id]"
                value="${articulo.value}"
            >

            <input
                type="hidden"
                name="detalles_rc[${indexRc}][talla]"
                value="${talla.value.trim()}"
            >
        `;

        tabla.appendChild(fila);
        contenedor.appendChild(campos);

        indexRc++;

        trabajador.value = '';
        articulo.value = '';
        talla.value = '';
    });

    tabla.addEventListener('click', function (event) {

        if (event.target.classList.contains('eliminar-rc')) {

            const fila = event.target.closest('tr');
            const index = fila.dataset.index;

            fila.remove();

            const campos = contenedor.querySelector(
                `[data-index="${index}"]`
            );

            if (campos) {
                campos.remove();
            }
        }
    });

});
</script>
