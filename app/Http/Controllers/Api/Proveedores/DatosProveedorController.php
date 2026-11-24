<?php

namespace App\Http\Controllers\Api\Proveedores;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Empresa;
use App\Models\Proveedores\Proveedor;
use App\Models\Proveedores\DatosProveedor;
use Illuminate\Http\Request;

class DatosProveedorController extends Controller
{
    public function vistaIndex()
    {
        $datosProveedores = DatosProveedor::with([
            'proveedor',
            'empresa'
        ])->orderByDesc('fecha')->paginate(10);

        return view(
            'Proveedores.DatosProveedor.index',
            compact('datosProveedores')
        );
    }

    public function vistaCreate()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        $empresas = Empresa::orderBy('nombre')->get();

        return view(
            'Proveedores.DatosProveedor.create',
            compact('proveedores', 'empresas')
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'folio' => 'required|string|max:11',
            'fecha' => 'required|date',
            'observaciones' => 'required|string|max:100',
            'tiempo_entrega' => 'required|string|max:50',
            'metodo_entrega' => 'required|string|max:50',
            'empresa_id' => 'required|exists:empresas,id',
            'correo' => 'required|email|max:50',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'tipo_contrato' => 'required|string|max:50',
        ]);

        DatosProveedor::create($datos);

        return redirect()
            ->route('datos_proveedor.index')
            ->with('success', 'Datos del proveedor registrados correctamente.');
    }

    public function vistaEdit(DatosProveedor $datos_proveedor)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        $empresas = Empresa::orderBy('nombre')->get();

        return view(
            'Proveedores.DatosProveedor.edit',
            compact('datos_proveedor', 'proveedores', 'empresas')
        );
    }

    public function update(Request $request, DatosProveedor $datos_proveedor)
    {
        $datos = $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'folio' => 'required|string|max:11',
            'fecha' => 'required|date',
            'observaciones' => 'required|string|max:100',
            'tiempo_entrega' => 'required|string|max:50',
            'metodo_entrega' => 'required|string|max:50',
            'empresa_id' => 'required|exists:empresas,id',
            'correo' => 'required|email|max:50',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'tipo_contrato' => 'required|string|max:50',
        ]);

        $datos_proveedor->update($datos);

        return redirect()
            ->route('datos_proveedor.index')
            ->with('success', 'Datos del proveedor actualizados correctamente.');
    }

    public function destroy(DatosProveedor $datos_proveedor)
    {
        $datos_proveedor->delete();

        return redirect()
            ->route('datos_proveedor.index')
            ->with('success', 'Datos del proveedor eliminados correctamente.');
    }
}