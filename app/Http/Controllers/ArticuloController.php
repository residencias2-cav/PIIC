<?php

namespace App\Http\Controllers;

use App\Models\Articulo;

use App\Http\Requests\{
    StoreArticuloRequest,
    UpdatearticuloRequest
    };
    
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = Articulo::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $articulos = Articulo::all();

        return response()->json([
            'status' => true,
            'data' => $articulos,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticuloRequest $request): JsonResponse
    {
        $articulo = Articulo::create($request->validated());

        return response()->json([
            'status' => true,
            'mesage' => 'Articulo registrado correctamente',
            'data'=> $articulo
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo): JsonResponse
    {
        //
        return response()-> json([
            'status'=>true,
            'data'=>$articulo
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdatearticuloRequest $request, 
        Articulo $articulo
    ): JsonResponse {
        $articulo -> update(
            $request->validated()
        );

        return response()->json([
            'status'=>true,
            'message'=>'Articulo actualizado correctamente',
            'data'=>$articulo
        ], 200);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo): JsonResponse
    {
        //
        $articulo->delete();

        return response()->json([
            'status' => true,
            'message'=>'Articulo eliminado correctamente'
        ], 200);
    }
}
