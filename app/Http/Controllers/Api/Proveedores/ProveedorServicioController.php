<?php

namespace App\Http\Controllers\Api\Proveedores;

use App\Http\Controllers\Controller;
use App\Models\Proveedores\ProveedorServicio;
use App\Models\Proveedores\Proveedor;
use App\Models\Catalogos\ProductoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorServicioController extends Controller
{
    /**
     * Mostrar las relaciones registradas.
     */
    public function vistaIndex()
    {
        $proveedorServicios = ProveedorServicio::with([
            'proveedor',
            'productoServicio'
        ])->paginate(10);

        return view(
            'ProveedorServicios.index',
            compact('proveedorServicios')
        );
    }

    /**
     * Mostrar el formulario de registro.
     */
    public function vistaCreate()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        $productosServicios = ProductoServicio::orderBy('nombre')->get();

        return view(
            'ProveedorServicios.create',
            compact('proveedores', 'productosServicios')
        );
    }

    /**
     * Registrar una nueva relación.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'proveedor_id' => [
                'required',
                'integer',
                'exists:proveedores,id'
            ],
            'producto_servicio_id' => [
                'required',
                'integer',
                'exists:producto_servicios,id'
            ],
        ]);

        $existe = DB::table('proveedor_servicios')
            ->where('proveedor_id', $datos['proveedor_id'])
            ->where('producto_servicio_id', $datos['producto_servicio_id'])
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors([
                    'producto_servicio_id' =>
                        'Esta relación entre proveedor y producto o servicio ya existe.'
                ]);
        }

        DB::table('proveedor_servicios')->insert([
            'proveedor_id' => $datos['proveedor_id'],
            'producto_servicio_id' => $datos['producto_servicio_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('proveedor_servicios.index')
            ->with('success', 'Relación registrada correctamente.');
    }

    /**
     * Redirigir a la edición del registro.
     */
    public function show($proveedor_id, $producto_servicio_id)
    {
        return redirect()->route('proveedor_servicios.edit', [
            $proveedor_id,
            $producto_servicio_id
        ]);
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function vistaEdit($proveedor_id, $producto_servicio_id)
    {
        $proveedorServicio = ProveedorServicio::with([
            'proveedor',
            'productoServicio'
        ])
            ->where('proveedor_id', $proveedor_id)
            ->where('producto_servicio_id', $producto_servicio_id)
            ->firstOrFail();

        $proveedores = Proveedor::orderBy('nombre')->get();

        $productosServicios = ProductoServicio::orderBy('nombre')->get();

        return view(
            'ProveedorServicios.edit',
            compact(
                'proveedorServicio',
                'proveedores',
                'productosServicios'
            )
        );
    }

    /**
     * Actualizar una relación.
     */
    public function update(
        Request $request,
        $proveedor_id,
        $producto_servicio_id
    ) {
        $datos = $request->validate([
            'proveedor_id' => [
                'required',
                'integer',
                'exists:proveedores,id'
            ],
            'producto_servicio_id' => [
                'required',
                'integer',
                'exists:producto_servicios,id'
            ],
        ]);

        $registro = DB::table('proveedor_servicios')
            ->where('proveedor_id', $proveedor_id)
            ->where('producto_servicio_id', $producto_servicio_id)
            ->first();

        if (!$registro) {
            abort(404);
        }

        $duplicado = DB::table('proveedor_servicios')
            ->where('proveedor_id', $datos['proveedor_id'])
            ->where('producto_servicio_id', $datos['producto_servicio_id'])
            ->where(function ($query) use ($proveedor_id, $producto_servicio_id) {
                $query->where('proveedor_id', '<>', $proveedor_id)
                    ->orWhere('producto_servicio_id', '<>', $producto_servicio_id);
            })
            ->exists();

        if ($duplicado) {
            return back()
                ->withInput()
                ->withErrors([
                    'producto_servicio_id' =>
                        'Esta relación entre proveedor y producto o servicio ya existe.'
                ]);
        }

        DB::table('proveedor_servicios')
            ->where('proveedor_id', $proveedor_id)
            ->where('producto_servicio_id', $producto_servicio_id)
            ->update([
                'proveedor_id' => $datos['proveedor_id'],
                'producto_servicio_id' => $datos['producto_servicio_id'],
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('proveedor_servicios.index')
            ->with('success', 'Relación actualizada correctamente.');
    }

    /**
     * Eliminar una relación.
     */
    public function destroy($proveedor_id, $producto_servicio_id)
    {
        $eliminados = DB::table('proveedor_servicios')
            ->where('proveedor_id', $proveedor_id)
            ->where('producto_servicio_id', $producto_servicio_id)
            ->delete();

        if (!$eliminados) {
            abort(404);
        }

        return redirect()
            ->route('proveedor_servicios.index')
            ->with('success', 'Relación eliminada correctamente.');
    }
}