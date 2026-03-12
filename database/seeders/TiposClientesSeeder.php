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
                'nombre' => 'Clientes Internos',
                'descripcion' => 'Clientes Internos',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 2,
                'nombre' => 'Clientes Externos',
                'descripcion' => 'Clientes Externos',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 3,
                'nombre' => 'Clientes Gubernamentales',
                'descripcion' => 'Clientes Gubernamentales',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 4,
                'nombre' => 'Clientes Distribuidores',
                'descripcion' => 'Clientes Distribuidores',
                'fecha_registro' => now(),
                'estado' => 2
            ]
        ]);
    }
}
