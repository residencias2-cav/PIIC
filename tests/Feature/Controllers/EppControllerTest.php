<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\Epp\EppController;
use App\Http\Requests\Epp\StoreEppRequest;
use App\Http\Requests\Epp\UpdateEppRequest;
use App\Models\Epp\Epp;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EppControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('PRAGMA foreign_keys = OFF');
    }

    public function test_index_lists_epps(): void
    {
        Epp::query()->create($this->payload());

        $response = app(EppController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
    }

    public function test_store_creates_an_epp(): void
    {
        $request = \Mockery::mock(StoreEppRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($this->payload());

        $response = app(EppController::class)->store($request);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertDatabaseHas('epps', ['folio' => 'EPP-TEST-001']);
    }

    public function test_show_update_and_destroy_an_epp(): void
    {
        $epp = Epp::query()->create($this->payload());
        $controller = app(EppController::class);

        $this->assertSame(200, $controller->show($epp)->getStatusCode());

        $update = \Mockery::mock(UpdateEppRequest::class);
        $update->shouldReceive('validated')->once()->andReturn(['motivo' => 'Actualizado']);
        $this->assertSame(200, $controller->update($update, $epp)->getStatusCode());
        $this->assertDatabaseHas('epps', ['id' => $epp->id, 'motivo' => 'Actualizado']);

        $this->assertSame(200, $controller->destroy($epp)->getStatusCode());
        $this->assertSoftDeleted('epps', ['id' => $epp->id]);
    }

    private function payload(): array
    {
        return [
            'fecha' => '2026-11-04',
            'folio' => 'EPP-TEST-001',
            'tipo_epp_id' => 1,
            'obra_id' => 1,
            'empresa_id' => 1,
            'motivo' => 'Reposicion',
            'justificacion' => 'Uso normal',
            'logistica' => 'Entrega directa',
            'created_by' => 1,
        ];
    }
}
