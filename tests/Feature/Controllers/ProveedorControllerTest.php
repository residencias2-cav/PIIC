<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\ProveedorController;
use App\Http\Requests\Proveedores\StoreProveedorRequest;
use App\Http\Requests\Proveedores\UpdateProveedorRequest;
use App\Models\Proveedores\Proveedor;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProveedorControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        require_once app_path('Http/Controllers/Api/Proveedores/ProveedorController.php');
        DB::statement('PRAGMA foreign_keys = OFF');
    }

    public function test_index_lists_suppliers(): void
    {
        Proveedor::query()->create($this->payload());

        $response = app(ProveedorController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
    }

    public function test_store_creates_supplier(): void
    {
        $request = \Mockery::mock(StoreProveedorRequest::class);
        $request->shouldReceive('all')->once()->andReturn($this->payload());

        $response = app(ProveedorController::class)->store($request);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertDatabaseHas('proveedors', ['nombre' => 'Proveedor Test']);
    }

    public function test_show_update_and_destroy_supplier(): void
    {
        $supplier = Proveedor::query()->create($this->payload());
        $controller = app(ProveedorController::class);

        $this->assertSame(200, $controller->show($supplier)->getStatusCode());

        $update = \Mockery::mock(UpdateProveedorRequest::class);
        $update->shouldReceive('all')->once()->andReturn(['area' => 'Logistica']);
        $this->assertSame(200, $controller->update($update, $supplier)->getStatusCode());
        $this->assertDatabaseHas('proveedors', ['id' => $supplier->id, 'area' => 'Logistica']);

        $this->assertSame(200, $controller->destroy($supplier)->getStatusCode());
        $this->assertDatabaseMissing('proveedors', ['id' => $supplier->id]);
    }

    private function payload(): array
    {
        return [
            'nombre' => 'Proveedor Test',
            'razon_social' => 'Proveedor Test SA',
            'curp' => 'PETT900101HDFXXX01',
            'rfc' => 'PETT900101ABC',
            'area' => 'Compras',
            'desc_bs' => 'Suministros',
            'vigencia_sat' => '2027-01-01',
            'inf_credito_id' => 1,
            'inf_contrato_id' => 1,
            'inf_impuestos' => 'Informacion fiscal',
            'registrado' => true,
        ];
    }
}
