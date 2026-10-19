<?php

namespace App\Http\Controllers;

use App\Models\TipoSangre;
use App\Http\Requests\StoreTipoSangreRequest;
use Illuminate\Http\Request;

class TipoSangreController extends Controller
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
    public function store(StoreTipoSangreRequest $request)
    {
        $tipo_sangre = TipoSangre::create($request->validated());

        return response()->json($tipo_sangre, 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(TipoSangre $tipo_sangre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(TipoSangre $tipo_sangre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, TipoSangre $tipo_sangre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(TipoSangre $tipo_sangre)
    {
        //
    }
}
