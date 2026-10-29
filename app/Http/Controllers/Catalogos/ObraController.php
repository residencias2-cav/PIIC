<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Obra;

use App\Http\Requests\Catalogos\{
    StoreObraRequest,
    UpdateObraRequest
    };

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obra = Obra::all();
        return response()->json($obra);
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
    public function store(StoreObraRequest $request)
    {
        $obra = Obra::create($request->validated());

        return response()->json($obra, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Obra $obra)
    {
        return response()->json($obra);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obra $obra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObraRequest $request, Obra $obra)
    {
        $obra->update($request->validated());
        
        return response()->json($obra);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obra $obra)
    {
        $obra->delete();
        
        return response()->json(null, 204);
    }
}
