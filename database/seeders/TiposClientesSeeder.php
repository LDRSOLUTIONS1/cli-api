<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposClientesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_tipos_clientes')->insert([
            [
                'id' => 1,
                'nombre' => 'Internos',
                'descripcion' => 'Internos',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 2,
                'nombre' => 'Externos',
                'descripcion' => 'Externos',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 3,
                'nombre' => 'Gubernamentales',
                'descripcion' => 'Gubernamentales',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 4,
                'nombre' => 'Distribuidores',
                'descripcion' => 'Distribuidores',
                'fecha_registro' => now(),
                'estado' => 2
            ]
        ]);
    }
}
