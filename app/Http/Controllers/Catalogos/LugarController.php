<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Lugar;

use App\Http\Requests\Catalogos\{
    UpdateLugarRequest,
    StoreLugarRequest
};

class LugarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lugar = Lugar::all();
        return response()->json($lugar);
    }

    public function vistaIndex()
    {
        $lugars = Lugar::all();

        return view(
            'catalogos.lugar.index',
            compact('lugars')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.lugar.create');
    }

    public function vistaEdit(Lugar $lugar)
    {
        return view(
            'catalogos.lugar.edit',
            compact('lugar')
        );
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
    public function store(StoreLugarRequest $request)
    {
        $lugar = Lugar::create($request->validated());

        return response()->json($lugar, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lugar $lugar)
    {
        return response()->json($lugar);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lugar $lugar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLugarRequest $request, Lugar $lugar)
    {
        $lugar->update($request->validated());
        
        return response()->json($lugar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lugar $lugar)
    {
        $lugar->delete();
        
        return response()->json(null, 204);
    }
}
