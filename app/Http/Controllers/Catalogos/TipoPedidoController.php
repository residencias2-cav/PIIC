<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\TipoPedido;

class TipoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_pedido = TipoPedido::all();

    return response()->json($tipo_pedido);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoPedido $request)
    {

    }
    /**
     * Display the specified resource.
     */
    public function show(TipoPedido $tipo_pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoPedido $tipo_pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoPedido $request, TipoPedido $tipo_pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoPedido $tipo_pedido)
    {
        //
    }
}
