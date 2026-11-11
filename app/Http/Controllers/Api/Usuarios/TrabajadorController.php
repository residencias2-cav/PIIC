<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Http\Controllers\Controller;

use App\Http\Requests\Usuarios\{
    StoreTrabajadorRequest,
    UpdateTrabajadorRequest
};

use App\Models\Usuarios\Trabajador;

use App\Models\Catalogos\{
    LugarNacimiento,
    TipoSangre
};

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API - Listado
    |--------------------------------------------------------------------------
    */

    public function index(): JsonResponse
    {
        $trabajadores = Trabajador::with([
            'lugarNacimiento',
            'tipoSangre',
        ])->get();

        return response()->json([
            'status' => true,
            'data' => $trabajadores,
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | WEB - Listado
    |--------------------------------------------------------------------------
    */

    public function vistaIndex()
    {
        $trabajadores = Trabajador::with([
            'lugarNacimiento',
            'tipoSangre',
        ])
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->orderBy('nombre')
            ->get();

        return view(
            'Usuarios.Trabajador.index',
            compact('trabajadores')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | WEB - Formulario Crear
    |--------------------------------------------------------------------------
    */

    public function vistaCreate()
    {
        $lugaresNacimiento = LugarNacimiento::orderBy('nombre')
            ->get();

        $tiposSangre = TipoSangre::orderBy('nombre')
            ->get();

        return view(
            'Usuarios.Trabajador.create',
            compact(
                'lugaresNacimiento',
                'tiposSangre'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | WEB - Formulario Editar
    |--------------------------------------------------------------------------
    */

    public function vistaEdit(Trabajador $trabajador)
    {
        $lugaresNacimiento = LugarNacimiento::orderBy('nombre')
            ->get();

        $tiposSangre = TipoSangre::orderBy('nombre')
            ->get();

        return view(
            'Usuarios.Trabajador.edit',
            compact(
                'trabajador',
                'lugaresNacimiento',
                'tiposSangre'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | API - Datos para creación
    |--------------------------------------------------------------------------
    */

    public function create(): JsonResponse
    {
        return response()->json([
            'status' => true,

            'lugares_nacimiento' =>
                LugarNacimiento::orderBy('nombre')->get(),

            'tipos_sangre' =>
                TipoSangre::orderBy('nombre')->get(),
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | Guardar
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreTrabajadorRequest $request
    ) {
        $trabajador = Trabajador::create(
            $request->validated()
        );


        /*
         * Petición desde API
         */
        if ($request->is('api/*')) {

            return response()->json([
                'status' => true,

                'message' =>
                    'Trabajador registrado correctamente.',

                'data' => $trabajador,
            ], 201);
        }


        /*
         * Petición desde Blade
         */
        return redirect()
            ->route('trabajador.index')
            ->with(
                'success',
                'Trabajador registrado correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | API - Mostrar trabajador
    |--------------------------------------------------------------------------
    */

    public function show(
        Trabajador $trabajador
    ): JsonResponse {

        $trabajador->load([
            'lugarNacimiento',
            'tipoSangre',
        ]);

        return response()->json([
            'status' => true,
            'data' => $trabajador,
        ], 200);
    }


    /*
    |--------------------------------------------------------------------------
    | Actualizar
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateTrabajadorRequest $request,
        Trabajador $trabajador
    ) {
        $trabajador->update(
            $request->validated()
        );


        /*
         * Petición API
         */
        if ($request->is('api/*')) {

            return response()->json([
                'status' => true,

                'message' =>
                    'Trabajador actualizado correctamente.',

                'data' => $trabajador,
            ], 200);
        }


        /*
         * Petición desde Blade
         */
        return redirect()
            ->route('trabajador.index')
            ->with(
                'success',
                'Trabajador actualizado correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Eliminar
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        Trabajador $trabajador
    ) {
        $trabajador->delete();


        /*
         * Petición API
         */
        if ($request->is('api/*')) {

            return response()->json([
                'status' => true,

                'message' =>
                    'Trabajador eliminado correctamente.',
            ], 200);
        }


        /*
         * Petición desde Blade
         */
        return redirect()
            ->route('trabajador.index')
            ->with(
                'success',
                'Trabajador eliminado correctamente.'
            );
    }
}
