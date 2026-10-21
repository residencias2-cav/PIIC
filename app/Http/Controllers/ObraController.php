<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Http\Requests\StoreObraRequest;
use App\Http\Requests\UpdateObraRequest;
use Illuminate\Http\Request;

class ObraController extends Controller
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
        //
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
    public function update(Request $request, Obra $obra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obra $obra)
    {
        //
    }
}
