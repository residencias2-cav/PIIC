<section
    id="seccion-epp-tr"
    class="formulario-seccion detalle-epp"
    style="display: none;"
>

    <h2 class="formulario-seccion-titulo">
        Detalle EPP TR
    </h2>

    <div class="formulario-grid">

        <div class="campo">

            <label for="tr_cantidad">
                Cantidad
            </label>

            <input
                type="number"
                id="tr_cantidad"
                min="1"
                placeholder="Ejemplo: 5"
            >

        </div>


        <div class="campo">

            <label for="tr_codigo">
                Código
            </label>

            <input
                type="text"
                id="tr_codigo"
                maxlength="50"
            >

        </div>

    </div>


    <div class="campo">

        <label for="tr_descripcion">
            Descripción
        </label>

        <input
            type="text"
            id="tr_descripcion"
            maxlength="100"
        >

    </div>


    <div class="formulario-grid">

        <div class="campo">

            <label for="tr_marca">
                Marca
            </label>

            <input
                type="text"
                id="tr_marca"
                maxlength="50"
            >

        </div>


        <div class="campo">

            <label for="tr_color">
                Color
            </label>

            <input
                type="text"
                id="tr_color"
                maxlength="50"
            >

        </div>

    </div>


    <div class="formulario-grid">

        <div class="campo">

            <label for="tr_medida">
                Medida
            </label>

            <input
                type="text"
                id="tr_medida"
                maxlength="50"
            >

        </div>


        <div class="campo">

            <label for="tr_clase">
                Clase
            </label>

            <input
                type="text"
                id="tr_clase"
                maxlength="50"
            >

        </div>

    </div>


    <div class="campo">

        <label for="tr_estado_id">
            Estado
        </label>

        <select id="tr_estado_id">

            <option value="">
                Selecciona un estado
            </option>

            @foreach ($estados as $estado)

                <option value="{{ $estado->id }}">
                    {{ $estado->nombre_estado }}
                </option>

            @endforeach

        </select>

    </div>


    <div class="campo">

        <label for="tr_observaciones">
            Observaciones
        </label>

        <textarea
            id="tr_observaciones"
            rows="3"
            maxlength="50"
        ></textarea>

    </div>


    <button
        type="button"
        id="agregar-tr"
        class="btn btn-principal"
    >
        + Agregar elemento
    </button>


    <div class="tabla-responsive">

        <table class="catalogo-tabla">

            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Medida</th>
                    <th>Clase</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody id="lista-elementos-tr">

                <tr id="tr-vacio">

                    <td
                        colspan="9"
                        class="estado-vacio"
                    >
                        No hay elementos agregados.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div id="inputs-ocultos-tr"></div>

</section>