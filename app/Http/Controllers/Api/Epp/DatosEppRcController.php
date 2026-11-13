<?php

namespace App\Http\Controllers\Api\Epp;

use App\Http\Requests\StoreDatosEppRcRequest;
use App\Http\Requests\UpdateDatosEppRcRequest;
use App\Models\Epp\DatosEppRc;
use Illuminate\Http\Request;

class DatosEppRcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos_epp_rc = DatosEppRc::all(); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datos_epp_rc = DatosEppRc::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDatosEppRcRequest $request)
    {
        //
        $datos_epp_rc = DatosEppRc::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosEppRc $datos_epp_rc)
    {
        //
        $datos_epp_rc = DatosEppRc::all();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosEppRc $datos_epp_rc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDatosEppRcRequest $request, DatosEppRc $datos_epp_rc)
    {
        //
        $datos_epp_rc->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosEppRc $datos_epp_rc)
    {
        //
        $datos_epp_rc->delete();
    }
}
