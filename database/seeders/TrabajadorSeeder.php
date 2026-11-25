<?php

namespace Database\Seeders;

use App\Models\Catalogos\Gerencia;
use App\Models\Catalogos\LugarNacimiento;
use App\Models\Catalogos\TipoSangre;
use App\Models\Usuarios\Trabajador;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lugarNacimiento = LugarNacimiento::where(
            'nombre',
            'Zacatecas'
        )->firstOrFail();

        $tipoSangre = TipoSangre::where(
            'nombre',
            'A+'
        )->firstOrFail();

        /*
         * Usuario personal de desarrollo ya existente.
         */
        Trabajador::updateOrCreate(
            [
                'nt' => 'TEST-MARCO-01',
            ],
            [
                'nombre' => 'Marco',
                'apellido_paterno' => 'Prueba',
                'apellido_materno' => 'Usuario',
                'sexo' => 'Hombre',
                'nss' => '00000000001',
                'curp' => 'XEXX000000HDFXXX00',
                'rfc' => 'XAXX000000AAA',
                'fecha_nacimiento' => '1990-01-01',
                'lugar_nacimiento_id' =>
                    $lugarNacimiento->id,
                'tipo_sangre_id' =>
                    $tipoSangre->id,
            ]
        );

        $gerenciasOperativas = Gerencia::query()
            ->whereNotIn('code', [
                'Subdir',
            ])
            ->orderBy('id')
            ->get();

        $consecutivo = 10;

        foreach ($gerenciasOperativas as $gerencia) {
            /*
             * Supervisor de la gerencia.
             */
            $this->crearTrabajadorPrueba(
                nt: 'SUP-'.strtoupper($gerencia->code),
                nombre: 'Supervisor',
                apellidoPaterno: $gerencia->code,
                apellidoMaterno: 'Prueba',
                consecutivo: $consecutivo++,
                lugarNacimientoId: $lugarNacimiento->id,
                tipoSangreId: $tipoSangre->id
            );

            /*
             * Gerente de la gerencia.
             */
            $this->crearTrabajadorPrueba(
                nt: 'GER-'.strtoupper($gerencia->code),
                nombre: 'Gerente',
                apellidoPaterno: $gerencia->code,
                apellidoMaterno: 'Prueba',
                consecutivo: $consecutivo++,
                lugarNacimientoId: $lugarNacimiento->id,
                tipoSangreId: $tipoSangre->id
            );
        }

        /*
         * Director para consulta global.
         */
        $this->crearTrabajadorPrueba(
            nt: 'DIR-SUBDIR',
            nombre: 'Director',
            apellidoPaterno: 'Subdireccion',
            apellidoMaterno: 'Prueba',
            consecutivo: $consecutivo++,
            lugarNacimientoId: $lugarNacimiento->id,
            tipoSangreId: $tipoSangre->id
        );

        /*
         * Usuario central de Compras.
         */
        $this->crearTrabajadorPrueba(
            nt: 'COM-GCOMP',
            nombre: 'Usuario',
            apellidoPaterno: 'Compras',
            apellidoMaterno: 'Prueba',
            consecutivo: $consecutivo++,
            lugarNacimientoId: $lugarNacimiento->id,
            tipoSangreId: $tipoSangre->id
        );

        /*
         * Administrador central.
         */
        $this->crearTrabajadorPrueba(
            nt: 'ADM-GTI',
            nombre: 'Administrador',
            apellidoPaterno: 'PIIC',
            apellidoMaterno: 'Prueba',
            consecutivo: $consecutivo,
            lugarNacimientoId: $lugarNacimiento->id,
            tipoSangreId: $tipoSangre->id
        );
    }

    /**
     * Crea o actualiza un trabajador ficticio
     * utilizando identificadores únicos.
     */
    private function crearTrabajadorPrueba(
        string $nt,
        string $nombre,
        string $apellidoPaterno,
        string $apellidoMaterno,
        int $consecutivo,
        int $lugarNacimientoId,
        int $tipoSangreId
    ): void {
        /*
         * Tu columna nt permite máximo 15 caracteres.
         */
        $nt = substr($nt, 0, 15);

        /*
         * NSS de 11 dígitos.
         */
        $nss = str_pad(
            (string) (90000000000 + $consecutivo),
            11,
            '0',
            STR_PAD_LEFT
        );

        /*
         * CURP ficticia de 18 caracteres.
         * Los últimos dos dígitos se usan para
         * conservar unicidad durante el desarrollo.
         */
        $curp = 'TSTA900101HZSSRS'
            .str_pad(
                (string) ($consecutivo % 100),
                2,
                '0',
                STR_PAD_LEFT
            );

        /*
         * RFC ficticio de 13 caracteres.
         */
        $rfc = 'TSTA900101'
            .str_pad(
                (string) ($consecutivo % 1000),
                3,
                '0',
                STR_PAD_LEFT
            );

        Trabajador::updateOrCreate(
            [
                'nt' => $nt,
            ],
            [
                'nombre' => $nombre,
                'apellido_paterno' => $apellidoPaterno,
                'apellido_materno' => $apellidoMaterno,
                'sexo' => 'Hombre',
                'nss' => $nss,
                'curp' => $curp,
                'rfc' => $rfc,
                'fecha_nacimiento' => '1990-01-01',
                'lugar_nacimiento_id' =>
                    $lugarNacimientoId,
                'tipo_sangre_id' =>
                    $tipoSangreId,
            ]
        );
    }
}