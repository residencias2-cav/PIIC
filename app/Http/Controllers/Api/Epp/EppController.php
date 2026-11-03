<?php

namespace App\Http\Controllers\Api\Epp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epp\{
    StoreEppRequest,
    UpdateEppRequest
    };
use App\Models\Epp\Epp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return response()->json([
            'data' => Epp::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        //
        $epp = Epp::all();

        return response()->json([
            'status' => true,
            'data' => $epp,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEppRequest $request)
    {
        //
        $epp =Epp::create($request->validated());

        return response()->json([
            'status' => true,
            'mesage' => 'Epp registrado correctamente',
            'data' => $epp
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Epp $epp): JsonResponse
    {
        //
        return response()-> json([
            'data' => $epp
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Epp $epp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEppRequest $request, Epp $epp):JsonResponse
    {
        //
        $epp->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Epp actualizado correctamente',
            'data' => $epp
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Epp $epp)
    {
        //
        $epp->delete();

        return response()->json([
            'status' => true,
            'message' => 'Registro EPP eliminado correctamente'
        ], 200);
    }
}
