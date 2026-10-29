<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\InfCredito;

use App\Http\Requests\Catalogos\{
    StoreInfCreditoRequest,
    UpdateInfCreditoRequest
    };

class InfCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inf_credito = InfCredito::all();
        return response()->json($inf_credito);
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
    public function store(StoreInfCreditoRequest $request)
    {
        $inf_credito = InfCredito::create($request->validated());

        return response()->json($inf_credito, 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(InfCredito $inf_credito)
    {
        return response()->json($inf_credito);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(InfCredito $inf_credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateInfCreditoRequest $request, InfCredito $inf_credito)
    {
        $inf_credito->update($request->validated());
        
        return response()->json($inf_credito);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(InfCredito $inf_credito)
    {
        $inf_credito->delete();
        
        return response()->json(null, 204);
    }
}
