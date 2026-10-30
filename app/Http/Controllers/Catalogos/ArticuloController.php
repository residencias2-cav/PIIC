<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Articulo;

use App\Http\Requests\Catalogos\{
    UpdateArticuloRequest,
    StoreArticuloRequest
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

    public function vistaIndex()
    {
        $articulos = Articulo::all();

        return view(
            'Catalogos.Articulo.index',
            compact('articulos')
        );
    }

    public function vistaCreate()
    {
        return view('Catalogos.Articulo.create');
    }

    public function vistaEdit(Articulo $articulo)
    {
        return view(
            'Catalogos.Articulo.edit',
            compact('articulo')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
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
    public function store(StoreArticuloRequest $request)
    {
        $articulo = Articulo::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($articulo, 201);
        }

        return redirect()
            ->route('articulo.index')
            ->with('success', 'Artículo registrado correctamente.');
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
    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {
        $articulo->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($articulo);
        }

        return redirect()
            ->route('articulo.index')
            ->with('success', 'Artículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Articulo $articulo)
    {
        $articulo->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('articulo.index')
            ->with('success', 'Artículo eliminado correctamente.');
    }
}
