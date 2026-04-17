<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cli_modelos')->insert([
            [
                'marca_id' => 1,
                'nombre' => 'P&V, LDT & MDT, HDT',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'marca_id' => 1,
                'nombre' => 'LDT & MDT, HDT',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'marca_id' => 1,
                'nombre' => 'P&V',
                'fecha_registro' => now(),
                'estado' => 2
            ]
        ]);
    }
}
