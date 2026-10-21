<?php

namespace App\Http\Controllers;

use App\Models\LugarNacimiento;
use Illuminate\Http\Request;

class LugarNacimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lugar_nacimiento = LugarNacimiento::all();

    return response()->json($lugar_nacimiento);
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
    public function store(LugarNacimiento $request)
    {

    }

    /**
     * Display the specified resource.
     */

    public function show(LugarNacimiento $lugar_nacimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(LugarNacimiento $lugar_nacimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, LugarNacimiento $lugar_nacimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(LugarNacimiento $lugar_nacimiento)
    {
        //
    }
}
