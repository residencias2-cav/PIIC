<?php

namespace App\Http\Controllers;

use App\Models\TipoEpp;
use App\Http\Requests\StoreTipoEppRequest;
use Illuminate\Http\Request;

class TipoEppController extends Controller
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
    public function store(StoreTipoEppRequest $request)
    {
        $tipo_epp = TipoEpp::create($request->validated());

        return response()->json($tipo_epp, 201);
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
