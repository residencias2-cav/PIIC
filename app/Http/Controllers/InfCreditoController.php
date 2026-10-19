<?php

namespace App\Http\Controllers;

use App\Models\InfCredito;
use App\Http\Requests\StoreInfCreditoRequest;
use Illuminate\Http\Request;

class InfCreditoController extends Controller
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
        //
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

    public function update(Request $request, InfCredito $inf_credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(InfCredito $inf_credito)
    {
        //
    }
}
