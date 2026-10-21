<?php

namespace App\Http\Controllers;

use App\Models\InfContrato;
use App\Http\Requests\StoreInfContratoRequest;
use App\Http\Requests\UpdateInfContratoRequest;
use Illuminate\Http\Request;

class InfContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inf_contrato = InfContrato::all();
        return response()->json($inf_contrato);
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
    public function store(StoreInfContratoRequest $request)
    {
        $inf_contrato = InfContrato::create($request->validated());

        return response()->json($inf_contrato, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InfContrato $inf_contrato)
    {
        return response()->json($inf_contrato);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(InfContrato $inf_contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateInfContratoRequest $request, InfContrato $inf_contrato)
    {
        $inf_contrato->update($request->validated());
        
        return response()->json($inf_contrato);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(InfContrato $inf_contrato)
    {
        $inf_contrato->delete();
        
        return response()->json(null, 204);
    }
}
