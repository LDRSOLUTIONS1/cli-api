<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelosSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_modelos')->insert([
            [
                'id'      => 1,
                'marca_id' => 1,
                'nombre'  => 'Pick Ups',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id'      => 2,
                'marca_id' => 1,
                'nombre'  => 'Vanes',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id'      => 3,
                'marca_id' => 1,
                'nombre'  => 'Vehículos Comerciales',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id'      => 4,
                'marca_id' => 1,
                'nombre'  => 'Camiones',
                'fecha_registro' => now(),
                'estado' => 2
            ]
        ]);
    }
}
