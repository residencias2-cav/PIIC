@php
    $detalleProducto = $detalleProducto ?? null;

    $valor = function ($campo, $predeterminado = '') use ($detalleProducto) {
        return old(
            'productos.' . $campo,
            $detalleProducto ? $detalleProducto->{$campo} : $predeterminado
        );
    };

    $fechaHora = function ($campo) use ($valor) {
        $fecha = $valor($campo);

        if (!$fecha) {
            return '';
        }

        return \Illuminate\Support\Carbon::parse($fecha)->format('Y-m-d\TH:i');
    };
@endphp

<h2 class="formulario-seccion-titulo">
    Datos de productos
</h2>

<div class="formulario-grid">

    {{-- FECHA DE FIRMA --}}

    <div class="campo">
        <label for="producto_fecha_firma">
            Fecha de firma
        </label>

        <input
            type="datetime-local"
            id="producto_fecha_firma"
            name="productos[fecha_firma]"
            value="{{ $fechaHora('fecha_firma') }}"
            required
        >
    </div>

    {{-- INFORMACIÓN DEL PRODUCTO --}}

    <div class="campo">
        <label for="producto_nombre">
            Nombre del producto
        </label>

        <input
            type="text"
            id="producto_nombre"
            name="productos[nombre_producto]"
            value="{{ $valor('nombre_producto') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_monto_total">
            Monto total
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="producto_monto_total"
            name="productos[monto_total]"
            value="{{ $valor('monto_total') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_iva">
            IVA
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="producto_iva"
            name="productos[iva]"
            value="{{ $valor('iva') }}"
            required
        >
    </div>

    {{-- INFORMACIÓN DE FACTURA --}}

    <div class="campo">
        <label for="producto_folio_factura">
            Folio de factura
        </label>

        <input
            type="text"
            id="producto_folio_factura"
            name="productos[folio_factura]"
            value="{{ $valor('folio_factura') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_factura">
            Factura
        </label>

        <input
            type="text"
            id="producto_factura"
            name="productos[factura]"
            value="{{ $valor('factura') }}"
            required
        >
    </div>

    {{-- MONTOS Y PORCENTAJES --}}

    <div class="campo">
        <label for="producto_monto">
            Monto
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="producto_monto"
            name="productos[monto]"
            value="{{ $valor('monto') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_porcentaje">
            Porcentaje
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="producto_porcentaje"
            name="productos[porcentaje]"
            value="{{ $valor('porcentaje') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_notificacion">
            Notificación
        </label>

        <input
            type="text"
            id="producto_notificacion"
            name="productos[notificacion]"
            value="{{ $valor('notificacion') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_descuento">
            Descuento
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="producto_descuento"
            name="productos[descuento]"
            value="{{ $valor('descuento') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="producto_saldo_pendiente">
            Saldo pendiente
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="producto_saldo_pendiente"
            name="productos[saldo_pendiente]"
            value="{{ $valor('saldo_pendiente') }}"
            required
        >
    </div>

    {{-- CATÁLOGOS --}}

    <div class="campo">
        <label for="producto_proveedor_id">
            Proveedor
        </label>

        <select
            id="producto_proveedor_id"
            name="productos[proveedor_id]"
            required
        >
            <option value="">
                Selecciona un proveedor
            </option>

            @foreach ($proveedores as $proveedor)
                <option
                    value="{{ $proveedor->id }}"
                    @selected($valor('proveedor_id') == $proveedor->id)
                >
                    {{ $proveedor->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="campo">
        <label for="producto_contrato_id">
            Contrato
        </label>

        <select
            id="producto_contrato_id"
            name="productos[contrato_id]"
            required
        >
            <option value="">
                Selecciona un contrato
            </option>

            @foreach ($contratos as $contrato)
                <option
                    value="{{ $contrato->id }}"
                    @selected($valor('contrato_id') == $contrato->id)
                >
                    {{ $contrato->nombre }}
                </option>
            @endforeach
        </select>
    </div>

</div>