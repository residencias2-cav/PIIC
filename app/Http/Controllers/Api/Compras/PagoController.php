<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\Pago;
use App\Models\Proveedores\Proveedor;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('proveedor')
            ->orderByDesc('id')
            ->paginate(10);

        return view('Compras.Pago.index', compact('pagos'));
    }

    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('Compras.Pago.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'precio' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'descuento' => 'required|numeric|min:0',
            'factura' => 'required|numeric|min:0',
            'comision' => 'required|numeric|min:0',
        ]);

        Pago::create($datos);

        return redirect()
            ->route('pago.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function edit(Pago $pago)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('Compras.Pago.edit', compact('pago', 'proveedores'));
    }

    public function update(Request $request, Pago $pago)
    {
        $datos = $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'precio' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'descuento' => 'required|numeric|min:0',
            'factura' => 'required|numeric|min:0',
            'comision' => 'required|numeric|min:0',
        ]);

        $pago->update($datos);

        return redirect()
            ->route('pago.index')
            ->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();

        return redirect()
            ->route('pago.index')
            ->with('success', 'Pago eliminado correctamente.');
    }
}