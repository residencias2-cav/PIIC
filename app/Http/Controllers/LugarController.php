<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Http\Requests\StoreLugarRequest;
use App\Http\Requests\UpdateLugarRequest;
use Illuminate\Http\Request;

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
