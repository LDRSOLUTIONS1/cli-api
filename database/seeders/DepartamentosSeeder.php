<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_departamentos')->insert([
            [
                'id' => 1,
                'nombre' => 'Dirección General',
                'descripcion' => 'Dirección General',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 2,
                'nombre' => 'Administración',
                'descripcion' => 'Administración',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 3,
                'nombre' => 'Sistemas',
                'descripcion' => 'Sistemas',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 4,
                'nombre' => 'Marketing',
                'descripcion' => 'Marketing',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 5,
                'nombre' => 'Comercial / Ventas',
                'descripcion' => 'Comercial / Ventas',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 6,
                'nombre' => 'Refacciones',
                'descripcion' => 'Refacciones',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 7,
                'nombre' => 'Servicio / Postventa',
                'descripcion' => 'Servicio / Postventa',
                'fecha_registro' => now(),
                'estado' => 2
            ],
        ]);
    }
}
