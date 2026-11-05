<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\UsuarioController;
use App\Http\Requests\Usuarios\StoreUsuarioRequest;
use App\Http\Requests\Usuarios\UpdateUsuarioRequest;
use App\Models\Usuarios\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        require_once app_path('Http/Controllers/Api/Usuarios/UsuarioController.php');
        $this->createParentRecords();
    }

    public function test_index_lists_users(): void
    {
        Usuario::query()->create($this->payload());

        $response = app(UsuarioController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
    }

    public function test_store_creates_user(): void
    {
        $request = \Mockery::mock(StoreUsuarioRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($this->payload());

        $response = app(UsuarioController::class)->store($request);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertDatabaseHas('usuarios', [
            'usuario' => 'usuario.test',
            'correo' => 'usuario@test.com',
        ]);
    }

    public function test_show_update_and_destroy_user(): void
    {
        $usuario = Usuario::query()->create($this->payload());
        $controller = app(UsuarioController::class);

        $this->assertSame(200, $controller->show($usuario)->getStatusCode());

        $update = \Mockery::mock(UpdateUsuarioRequest::class);
        $update->shouldReceive('validated')->once()->andReturn([
            'usuario' => 'usuario.actualizado',
        ]);

        $this->assertSame(200, $controller->update($update, $usuario)->getStatusCode());
        $this->assertDatabaseHas('usuarios', [
            'id' => $usuario->id,
            'usuario' => 'usuario.actualizado',
        ]);

        $this->assertSame(200, $controller->destroy($usuario)->getStatusCode());
        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }

    private function createParentRecords(): void
    {
        $now = now();

        DB::table('lugar_nacimientos')->insert([
            'id' => 1,
            'nombre' => 'Zacatecas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('tipo_sangres')->insert([
            'id' => 1,
            'nombre' => 'O+',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('trabajadors')->insert([
            'id' => 1,
            'nt' => 'NT-001',
            'nombre' => 'Usuario',
            'apellido_paterno' => 'Prueba',
            'apellido_materno' => 'Controller',
            'sexo' => 'Hombre',
            'nss' => '12345678901',
            'curp' => 'UPCC900101HZSLRN01',
            'rfc' => 'UPCC900101ABC',
            'fecha_nacimiento' => '1990-01-01',
            'lugar_nacimiento_id' => 1,
            'tipo_sangre_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('gerencias')->insert([
            'id' => 1,
            'nombre' => 'Gerencia de prueba',
            'code' => 'TEST',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('tipo_usuarios')->insert([
            'id' => 1,
            'nombre' => 'Administrador',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function payload(): array
    {
        return [
            'trabajador_id' => 1,
            'gerencia_id' => 1,
            'usuario' => 'usuario.test',
            'tipo_usuario_id' => 1,
            'tipos_usuario_ch' => true,
            'contrasena' => 'secreto123',
            'correo' => 'usuario@test.com',
            'contrasena_correo' => 'correo123',
            'twofa_code' => '12345678901234567890123456789012',
            'twofa_expire' => '2026-12-31',
            'twofa_attempts' => 0,
        ];
    }
}
