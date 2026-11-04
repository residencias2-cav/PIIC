<?php

namespace App\Http\Controllers;

use App\Models\Compras\Pedido;
use App\Http\Requests\Compras\{
    StorePedidoRequest,
    UpdatePedidoRequest
    };
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'data' => Pedido::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pedido = Pedido::all();

        return response()->json([
            'status' => true,
            'data' => $pedido,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        //
        $pedido = Pedido::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Pedido registrado correctamente',
            'data' => $pedido
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $pedido,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        //
        $pedido->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Pedido actualizado correctamente',
            'data' => $pedido
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
        $pedido->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pedido eliminado correctamente',
        ], 200);
    }
}
