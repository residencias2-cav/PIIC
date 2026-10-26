<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\TipoCotizacion;

class TipoCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_cotizacion = TipoCotizacion::all();

    return response()->json($tipo_cotizacion);
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
    public function store(TipoCotizacion $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(TipoCotizacion $tipo_cotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoCotizacion $tipo_cotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoCotizacion $tipo_cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoCotizacion $tipo_cotizacion)
    {
        //
    }
}
