<?php

namespace App\Http\Controllers;

use App\Models\TipoPedido;
use App\Http\Requests\StoreTipoPedidoRequest;
use Illuminate\Http\Request;

class TipoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTipoPedidoRequest $request)
    {
        $tipo_pedido = TipoPedido::create($request->validated());

        return response()->json($tipo_pedido, 201);
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
    public function update(Request $request, TipoPedido $tipo_pedido)
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
