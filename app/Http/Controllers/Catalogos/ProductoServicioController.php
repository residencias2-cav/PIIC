<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\ProductoServicio;

use App\Http\Requests\Catalogos\{
    UpdateProductoServicioRequest,
    StoreProductoServicioRequest
};

class ProductoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto_servicio = ProductoServicio::all();
        return response()->json($producto_servicio);
    }

    public function vistaIndex()
    {
        $producto_servicios = ProductoServicio::all();

        return view(
            'catalogos.producto_servicio.index',
            compact('producto_servicios')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.producto_servicio.create');
    }

    public function vistaEdit(ProductoServicio $producto_servicio)
    {
        return view(
            'catalogos.producto_servicio.edit',
            compact('producto_servicio')
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
    public function store(StoreProductoServicioRequest $request)
    {
        $productoservicio = ProductoServicio::create($request->validated());

        return response()->json($productoservicio, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductoServicio $producto_servicio)
    {
        return response()->json($producto_servicio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductoServicio $producto_servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoServicioRequest $request, ProductoServicio $producto_servicio)
    {
        $producto_servicio->update($request->validated());
        
        return response()->json($producto_servicio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoServicio $producto_servicio)
    {
        $producto_servicio->delete();
        
        return response()->json(null, 204);
    }
}
