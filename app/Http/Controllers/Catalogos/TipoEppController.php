<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\TipoEpp;

class TipoEppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_epp = TipoEpp::all();

    return response()->json($tipo_epp);
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
    public function store(TipoEpp $request)
    {

    }

    /**
     * Display the specified resource.
     */

    public function show(TipoEpp $tipo_epp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(TipoEpp $tipo_epp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, TipoEpp $tipo_epp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(TipoEpp $tipo_epp)
    {
        //
    }
}
