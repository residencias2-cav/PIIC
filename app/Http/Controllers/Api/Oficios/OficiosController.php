<?php
namespace App\Http\Controllers\Api\Oficios;

use App\Http\Controllers\Controller;

use App\Http\Requests\Oficios\StoreOficiosRequest;
use App\Http\Requests\Oficios\UpdateOficiosRequest;

use App\Models\Oficios\Oficios;
use App\Models\Oficios\OficiosRepse;
use App\Models\Oficios\OficiosProductos;
use App\Models\Oficios\OficiosComisiones;
use App\Models\Oficios\OficiosRutas;

use App\Models\Catalogos\{
    Estado,
    TipoOficio,
    Contrato,
    Empresa
};

use App\Models\Proveedores\Proveedor;
use App\Models\Usuarios\Trabajador;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OficiosController extends Controller
{

    /**
     * Mostrar el listado de oficios.
     */
    public function vistaIndex()
    {
        $oficios = Oficios::with([
            'tipoOficio',
            'estado'
        ])->orderBy('id', 'desc')->get();

        return view('Oficios.Oficios.index', compact('oficios'));
    }

    /**
     * Mostrar el formulario para registrar un oficio.
     */
    public function vistaCreate()
    {
        $tiposOficio = TipoOficio::orderBy('nombre')->get();

        $estados = Estado::orderBy('nombre_estado')->get();

        $contratos = Contrato::orderBy('nombre')->get();

        $proveedores = Proveedor::orderBy('nombre')->get();

        $empresas = Empresa::orderBy('nombre')->get();

        $trabajadores = Trabajador::orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $siguienteFolio = $this->generarFolio();

        $fechaInicial = now()->toDateString();

        return view('Oficios.Oficios.create', compact(
            'tiposOficio',
            'estados',
            'contratos',
            'proveedores',
            'empresas',
            'trabajadores',
            'siguienteFolio',
            'fechaInicial'
        ));
    }

    /**
     * Mostrar el formulario para editar un oficio.
     */
    
    public function vistaEdit(Oficios $oficios)
    {
        // Catálogos
        $tiposOficio = TipoOficio::orderBy('nombre')->get();

        $estados = Estado::orderBy('nombre_estado')->get();

        $contratos = Contrato::orderBy('nombre')->get();

        $proveedores = Proveedor::orderBy('nombre')->get();

        $empresas = Empresa::orderBy('nombre')->get();

        $trabajadores = Trabajador::orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        // Cargar el oficio y sus detalles
        $oficios->load([
            'tipoOficio',
            'estado',
            'oficiosProducto',
            'oficiosRepSe',
            'oficiosRutas',
            'oficiosComisiones'
        ]);

        return view('Oficios.Oficios.edit', compact(
            'oficios',
            'tiposOficio',
            'estados',
            'contratos',
            'proveedores',
            'empresas',
            'trabajadores'
        ));
    }


    /**
     * Generar el siguiente folio de oficio.
     */
    private function generarFolio()
    {
        $ultimoNumero = Oficios::selectRaw(
            'MAX(CAST(SUBSTRING(folio, 5) AS UNSIGNED)) as ultimo_numero'
        )->value('ultimo_numero');

        $siguienteNumero = ($ultimoNumero ?? 0) + 1;

        return 'OFI-' . str_pad(
            $siguienteNumero,
            3,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Listado en formato JSON.
     */
    public function index()
    {
        return response()->json([
            'data' => Oficios::all(),
        ], 200);
    }

    /**
     * Consulta en formato JSON.
     */
    public function create()
    {
        $oficios = Oficios::all();

        return response()->json([
            'status' => true,
            'data' => $oficios,
        ], 200);
    }

    /**
     * Guardar un nuevo oficio y su detalle correspondiente.
     */
    public function store(StoreOficiosRequest $request)
    {
        $datos = $request->validated();

        $oficio = DB::transaction(function () use ($datos) {

            // Obtener el tipo de oficio seleccionado.
            $tipoOficio = TipoOficio::findOrFail(
                $datos['tipo_oficio_id']
            );

            // Relacionar cada tipo con su formulario.
            $detalles = [
                'Oficios repse' => 'repse',
                'Oficios productos' => 'productos',
                'Oficios comisiones' => 'comisiones',
                'Oficios rutas' => 'rutas',
            ];

            $campoDetalle = $detalles[$tipoOficio->nombre] ?? null;

            // Comprobar que exista el detalle correspondiente.
            if (
                !$campoDetalle ||
                empty($datos[$campoDetalle]) ||
                !is_array($datos[$campoDetalle])
            ) {
                throw ValidationException::withMessages([
                    'tipo_oficio_id' => 'Debes completar el formulario correspondiente al tipo de oficio seleccionado.'
                ]);
            }

            // Crear el oficio principal.
            $oficio = Oficios::create([
                'folio' => $this->generarFolio(),
                'fecha' => now()->toDateString(),
                'asunto' => $datos['asunto'],
                'cuerpo' => $datos['cuerpo'],
                'tipo_oficio_id' => $datos['tipo_oficio_id'],
                'estado_id' => $datos['estado_id'],
                'observaciones' => $datos['observaciones'] ?? '',
                'cargos_generales' => $datos['cargos_generales'] ?? '',
            ]);

            // Obtener únicamente los datos del detalle seleccionado.
            $detalle = $datos[$campoDetalle];

            // Guardar el detalle según el tipo de oficio.
            switch ($campoDetalle) {

                case 'repse':

                    $detalle['oficio_id'] = $oficio->id;

                    OficiosRepse::create($detalle);

                    break;

                case 'productos':

                    $detalle['oficios_id'] = $oficio->id;

                    OficiosProductos::create($detalle);

                    break;

                case 'comisiones':

                    $detalle['oficio_id'] = $oficio->id;

                    OficiosComisiones::create($detalle);

                    break;

                case 'rutas':

                    $detalle['oficio_id'] = $oficio->id;

                    OficiosRutas::create($detalle);

                    break;
            }

            return $oficio;
        });

        return redirect()
            ->route('oficios.index')
            ->with('success', 'Oficio registrado correctamente.');
    }

    /**
     * Mostrar un oficio.
     */
    public function show(Oficios $oficios)
    {
        return response()->json([
            'status' => true,
            'data' => $oficios
        ], 200);
    }

    /**
     * Método original de edición.
     */
    public function edit(Oficios $oficios)
    {
        return $this->vistaEdit($oficios);
    }

    /**
     * Actualizar un oficio desde el formulario web.
     */
    
    public function update(
        UpdateOficiosRequest $request,
        Oficios $oficios
    ) {
        $datos = $request->validated();

        // Identificar el tipo de oficio seleccionado.
        $tipoOficio = TipoOficio::findOrFail($datos['tipo_oficio_id']);

        // Relacionar cada tipo con su sección y relación.
        $tipos = [
            'Oficios repse' => [
                'campo' => 'repse',
                'relacion' => 'oficiosRepSe',
            ],
            'Oficios productos' => [
                'campo' => 'productos',
                'relacion' => 'oficiosProducto',
            ],
            'Oficios comisiones' => [
                'campo' => 'comisiones',
                'relacion' => 'oficiosComisiones',
            ],
            'Oficios rutas' => [
                'campo' => 'rutas',
                'relacion' => 'oficiosRutas',
            ],
        ];

        $configuracion = $tipos[$tipoOficio->nombre] ?? null;

        if (!$configuracion || empty($datos[$configuracion['campo']])) {
            return back()
                ->withErrors(['detalle' => 'Debes completar los datos del tipo de oficio seleccionado.'])
                ->withInput();
        }

        \Illuminate\Support\Facades\DB::transaction(function () use (
            $datos,
            $oficios,
            $configuracion
        ) {
            // Separar los datos generales de los datos de detalle.
            $detalle = $datos[$configuracion['campo']];

            unset(
                $datos['folio'],
                $datos['fecha'],
                $datos['repse'],
                $datos['productos'],
                $datos['comisiones'],
                $datos['rutas']
            );

            // Actualizar los datos generales.
            $oficios->update($datos);

            // Relaciones de detalle del oficio.
            $relaciones = [
                'oficiosRepSe',
                'oficiosProducto',
                'oficiosComisiones',
                'oficiosRutas',
            ];

            foreach ($relaciones as $nombreRelacion) {
                $relacion = $oficios->{$nombreRelacion}();

                if ($nombreRelacion === $configuracion['relacion']) {
                    // Actualizar el detalle existente o crear uno nuevo.
                    $registro = $relacion->first();

                    if ($registro) {
                        $registro->update($detalle);

                        // Eliminar posibles registros adicionales.
                        $relacion->where('id', '!=', $registro->id)->delete();
                    } else {
                        $relacion->create($detalle);
                    }
                } else {
                    // Eliminar los detalles de los tipos que ya no corresponden.
                    $relacion->delete();
                }
            }
        });

        return redirect()
            ->route('oficios.index')
            ->with('success', 'Oficio actualizado correctamente.');
    }

}
