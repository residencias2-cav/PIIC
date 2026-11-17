<?php

namespace App\Http\Controllers\Api\Epp;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Epp\{
    StoreEppRequest,
    UpdateEppRequest
    };
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Usuarios\Trabajador;
use App\Models\Epp\Epp;

use App\Models\Catalogos\{
    TipoEpp,
    Obra,
    Empresa,
    Articulo,
    Estado
};

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

    public function vistaIndex()
    {
        $epps = Epp::with([
            'tipoEpp',
            'obra',
            'empresa',
        ])
            ->latest('fecha')
            ->get();

        return view(
            'Epp.Epp.index',
            compact('epps')
        );
    }

    public function vistaCreate()
    {
        $estados = Estado::all();
        
        $tiposEpp = TipoEpp::all();

        $obras = Obra::orderBy('nombre_obra')->get();

        $empresas = Empresa::orderBy('nombre')->get();

        $trabajadores = Trabajador::orderBy('nombre')->get();

        $articulos = Articulo::orderBy('nombre')->get();

        $ultimoNumero = Epp::withTrashed()
            ->selectRaw(
                "MAX(CAST(SUBSTRING(folio, 5) AS UNSIGNED)) AS ultimo"
            )
            ->value('ultimo');

        $siguienteNumero = ($ultimoNumero ?? 0) + 1;

        $siguienteFolio = 'EPP-' . str_pad(
            $siguienteNumero,
            3,
            '0',
            STR_PAD_LEFT
        );

        return view(
            'epp.epp.create',
            compact( 
                'tiposEpp',
                'obras',
                'empresas',
                'estados',
                'trabajadores',
                'articulos',
                'siguienteFolio'
            )
        );
    }

    public function vistaEdit(Epp $epp)
    {
        $estados = Estado::all();

        $tiposEpp = TipoEpp::all();

        $obras = Obra::orderBy('nombre_obra')->get();

        $empresas = Empresa::orderBy('nombre')->get();

        return view(
            'Epp.Epp.edit',
            compact(
                'epp',
                'tiposEpp',
                'obras',
                'empresas',
                'estado',
            )
        );
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
    $datos = $request->validated();

    return DB::transaction(function () use ($request, $datos) {

        $ultimoNumero = Epp::withTrashed()
            ->selectRaw(
                "MAX(CAST(SUBSTRING(folio, 5) AS UNSIGNED)) AS ultimo"
            )
            ->value('ultimo');

        $siguienteNumero = ($ultimoNumero ?? 0) + 1;

        $folio = 'EPP-' . str_pad(
            $siguienteNumero,
            3,
            '0',
            STR_PAD_LEFT
        );

        // Crear solicitud principal de EPP
        $epp = Epp::create([
            'fecha' => now()->toDateString(),
            'folio' => $folio,
            'tipo_epp_id' => $datos['tipo_epp_id'],
            'obra_id' => $datos['obra_id'],
            'empresa_id' => $datos['empresa_id'],
            'motivo' => $datos['motivo'],
            'justificacion' => $datos['justificacion'],
            'logistica' => $datos['logistica'],
            'created_by' => Auth::id(),
        ]);

        // Guardar detalles de EPP TR
        foreach ($datos['detalles_tr'] ?? [] as $detalle) {

            $epp->datosEppTr()->create([
                'cantidad' => $detalle['cantidad'],
                'descripcion' => $detalle['descripcion'],
                'codigo' => $detalle['codigo'],
                'marca' => $detalle['marca'],
                'color' => $detalle['color'],
                'medida' => $detalle['medida'],
                'clase' => $detalle['clase'],
                'observaciones' => $detalle['observaciones'],
                'estado_id' => $detalle['estado_id'],
                'fecha_estado' => now()->toDateString(),
            ]);
        }

        // Guardar detalles de EPP NI
        foreach ($datos['detalles_ni'] ?? [] as $detalle) {

            $epp->datosEppNi()->create([
                'trabajador_id' => $detalle['trabajador_id'],
                'articulo_id' => $detalle['articulo_id'],
                'sup_int' => $detalle['sup_int'],
            ]);
        }

        // Guardar detalles de EPP RE
        foreach ($datos['detalles_re'] ?? [] as $detalle) {

            // Obtener la fotografía cargada desde la computadora
            $foto = $detalle['foto_evidencia'];

            // Generar un nombre único para la fotografía
            $extension = strtolower($foto->getClientOriginalExtension());
            $nombreFoto = Str::random(32) . '.' . $extension;

            // Guardar la fotografía en storage/app/public/epp/re
            $rutaFoto = $foto->storeAs(
                'epp/re',
                $nombreFoto,
                'public'
            );

            // Crear registro de EPP RE
            $epp->datosEppRe()->create([
                'trabajador_id' => $detalle['trabajador_id'],
                'fecha_ingreso' => $detalle['fecha_ingreso'],
                'motivo' => $detalle['motivo'],
                'articulo_id' => $detalle['articulo_id'],
                'fecha_entrega' => $detalle['fecha_entrega'],
                'foto_evidencia' => $rutaFoto,
                'observaciones' => $detalle['observaciones'],
                'talla' => $detalle['talla'],
                'estado_id' => $detalle['estado_id'],
                'fecha_estado' => $detalle['fecha_estado'],
            ]);
        }

        // Respuesta para solicitudes API
        if ($request->is('api/*')) {
            return response()->json(
                $epp->load([
                    'datosEppTr',
                    'datosEppNi',
                    'datosEppRe',
                ]),
                201
            );
        }

        // Regresar al listado
        return redirect()
            ->route('epp.index')
            ->with(
                'success',
                'Solicitud de EPP registrada correctamente.'
            );
    });
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
    public function update(UpdateEppRequest $request, Epp $epp) 
    {
        $epp->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($epp);
        }

        return redirect()
            ->route('epp.index')
            ->with(
                'success',
                'Solicitud de EPP actualizada correctamente.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Epp $epp)
    {
        $epp->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('epp.index')
            ->with(
                'success',
                'Solicitud de EPP eliminada correctamente.'
            );
    }
}
