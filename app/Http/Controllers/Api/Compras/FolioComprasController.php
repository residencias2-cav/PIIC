<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\FolioCompras;
use App\Models\Compras\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FolioComprasController extends Controller
{
    /**
     * Mostrar los folios de compras registrados.
     */
    public function index()
    {
        $folioCompras = FolioCompras::with('pedido')
            ->latest()
            ->paginate(10);

        return view(
            'Compras.FolioCompras.index',
            compact('folioCompras')
        );
    }

    /**
     * Mostrar el formulario para registrar un folio.
     */
    public function create()
    {
        $pedidos = Pedido::orderBy('id', 'desc')->get();

        return view(
            'Compras.FolioCompras.create',
            compact('pedidos')
        );
    }

    /**
     * Guardar un nuevo folio de compra.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'pedido_id' => [
                'required',
                'integer',
                'exists:pedidos,id'
            ],
            'fecha' => [
                'required',
                'date'
            ],
            'folio' => [
                'required',
                'string',
                'max:20',
                'unique:folio_compras,folio'
            ],
            'notas_autorizacion' => [
                'required',
                'string',
                'max:100'
            ],
            'observaciones' => [
                'required',
                'string',
                'max:100'
            ],
        ]);

        FolioCompras::create($datos);

        return redirect()
            ->route('folio_compras.index')
            ->with('success', 'Folio de compra registrado correctamente.');
    }

    /**
     * Mostrar un folio específico.
     */
    public function show(FolioCompras $folio_compra)
    {
        return redirect()->route(
            'folio_compras.edit',
            $folio_compra->id
        );
    }

    /**
     * Mostrar el formulario para editar un folio.
     */
    public function edit(FolioCompras $folio_compra)
    {
        $pedidos = Pedido::orderBy('id', 'desc')->get();

        $folioCompra = $folio_compra;

        return view(
            'Compras.FolioCompras.edit',
            compact('folioCompra', 'pedidos')
        );
    }

    /**
     * Actualizar un folio de compra.
     */
    public function update(Request $request, FolioCompras $folio_compra)
    {
        $datos = $request->validate([
            'pedido_id' => [
                'required',
                'integer',
                'exists:pedidos,id'
            ],
            'fecha' => [
                'required',
                'date'
            ],
            'folio' => [
                'required',
                'string',
                'max:20',
                Rule::unique('folio_compras', 'folio')
                    ->ignore($folio_compra->id)
            ],
            'notas_autorizacion' => [
                'required',
                'string',
                'max:100'
            ],
            'observaciones' => [
                'required',
                'string',
                'max:100'
            ],
        ]);

        $folio_compra->update($datos);

        return redirect()
            ->route('folio_compras.index')
            ->with('success', 'Folio de compra actualizado correctamente.');
    }

    /**
     * Eliminar un folio de compra.
     */
    public function destroy(FolioCompras $folio_compra)
    {
        $folio_compra->delete();

        return redirect()
            ->route('folio_compras.index')
            ->with('success', 'Folio de compra eliminado correctamente.');
    }
}