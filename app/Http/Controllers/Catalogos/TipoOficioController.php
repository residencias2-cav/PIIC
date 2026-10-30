<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\TipoOficio;

class TipoOficioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_oficio = TipoOficio::all();

    return response()->json($tipo_oficio);
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
    public function store(TipoOficio $request)
    {

    }

    /**
     * Display the specified resource.
     */

    public function show(TipoOficio $tipo_oficio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(TipoOficio $tipo_oficio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(TipoOficio $request, TipoOficio $tipo_oficio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(TipoOficio $tipo_oficio)
    {
        //
    }
}
