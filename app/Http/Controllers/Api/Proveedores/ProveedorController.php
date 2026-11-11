<?php

namespace App\Http\Controllers\Api\Proveedores;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proveedores\{
    StoreProveedorRequest,
    UpdateProveedorRequest
};
use App\Models\Proveedores\Proveedor;
use App\Models\Catalogos\{
    InfCredito,
    InfContrato
};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{

    public function index(): JsonResponse
    {
        $proveedores = Proveedor::with([
            'infCredito',
            'infContrato',
        ])->get();

        return response()->json([
            'status' => true,
            'data' => $proveedores,
        ], 200);
    }

    public function vistaIndex()
    {
        $proveedores = Proveedor::with([
            'infCredito',
            'infContrato',
        ])
            ->orderBy('nombre')
            ->get();

        return view(
            'Proveedores.Proveedor.index',
            compact('proveedores')
        );
    }

    public function vistaCreate()
    {
        $creditos = InfCredito::orderBy('monto')
            ->get();

        $contratos = InfContrato::orderBy('tipo_contrato')
            ->get();

        return view(
            'Proveedores.Proveedor.create',
            compact(
                'creditos',
                'contratos'
            )
        );
    }

    public function vistaEdit(Proveedor $proveedor)
    {
        $creditos = InfCredito::orderBy('monto')
            ->get();

        $contratos = InfContrato::orderBy('tipo_contrato')
            ->get();

        return view(
            'Proveedores.Proveedor.edit',
            compact(
                'proveedor',
                'creditos',
                'contratos'
            )
        );
    }

    public function create(): JsonResponse
    {
        return response()->json([
            'status' => true,

            'creditos' =>
                InfCredito::all(),

            'contratos' =>
                InfContrato::all(),
        ], 200);
    }

    public function store(
        StoreProveedorRequest $request
    ) {
        $proveedor = Proveedor::create(
            $request->validated()
        );

        if ($request->is('api/*')) {

            return response()->json([
                'status' => true,

                'message' =>
                    'Proveedor registrado correctamente.',

                'data' => $proveedor,
            ], 201);
        }
        return redirect()
            ->route('proveedor.index')
            ->with(
                'success',
                'Proveedor registrado correctamente.'
            );
    }

    public function show(
        Proveedor $proveedor
    ): JsonResponse {

        $proveedor->load([
            'infCredito',
            'infContrato',
        ]);

        return response()->json([
            'status' => true,
            'data' => $proveedor,
        ], 200);
    }

    public function update(
        UpdateProveedorRequest $request,
        Proveedor $proveedor
    ) {
        $proveedor->update(
            $request->validated()
        );

        if ($request->is('api/*')) {

            return response()->json([
                'status' => true,

                'message' =>
                    'Proveedor actualizado correctamente.',

                'data' => $proveedor,
            ], 200);
        }

        return redirect()
            ->route('proveedor.index')
            ->with(
                'success',
                'Proveedor actualizado correctamente.'
            );
    }

    public function destroy(
        Request $request,
        Proveedor $proveedor
    ) {
        $proveedor->delete();

        if ($request->is('api/*')) {

            return response()->json([
                'status' => true,

                'message' =>
                    'Proveedor eliminado correctamente.',
            ], 200);
        }

        return redirect()
            ->route('proveedor.index')
            ->with(
                'success',
                'Proveedor eliminado correctamente.'
            );
    }
}
