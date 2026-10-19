<?php

namespace App\Http\Controllers;

use App\Models\TipoCompra;
use App\Http\Requests\StoreTipoCompraRequest;
use App\Http\Requests\UpdateTipoCompraRequest;
use Illuminate\Http\Request;

class TipoCompraController extends Controller
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
    public function store(StoreTipoCompraRequest $request)
    {
        $tipo_compra = TipoCompra::create($request->validated());

        return response()->json($tipo_compra, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoCompra $tipo_compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoCompra $tipo_compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoCompra $tipo_compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoCompra $tipo_compra)
    {
        //
    }
}
