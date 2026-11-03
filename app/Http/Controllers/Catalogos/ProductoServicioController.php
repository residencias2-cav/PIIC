<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\ProductoServicio;

use App\Http\Requests\Catalogos\{
    UpdateProductoServicioRequest,
    StoreProductoServicioRequest
};

use Illuminate\Http\Request;

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
        $productoServicios = ProductoServicio::all();

        return view(
            'catalogos.ProductoServicio.index',
            compact('productoServicios')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.ProductoServicio.create');
    }

    public function vistaEdit(ProductoServicio $productoServicio)
    {
        return view(
            'catalogos.ProductoServicio.edit',
            compact('productoServicio')
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
        $producto_servicio = ProductoServicio::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($producto_servicio, 201);
        }

        return redirect()
            ->route('producto_servicio.index')
            ->with('success', 'Producto o Servicio registrado correctamente.');
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

        if ($request->is('api/*')) {
            return response()->json($producto_servicio);
        }

        return redirect()
            ->route('producto_servicio.index')
            ->with('success', 'Producto o Servicio actualizado correctamente.');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProductoServicio $producto_servicio)
    {
        $producto_servicio->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('producto_servicio.index')
            ->with('success', 'Producto o Servicio eliminado correctamente.');
    }
}
 