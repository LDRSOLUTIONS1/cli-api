<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionalesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cli_regionales')->insert([
            [
                'nombre' => 'Arturo',
                'apellido_paterno' => 'Vargas',
                'apellido_materno' => null,
                'correo_electronico' => null,
                'telefono' => null,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'nombre' => 'Axel',
                'apellido_paterno' => 'Guzman',
                'apellido_materno' => null,
                'correo_electronico' => null,
                'telefono' => null,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'nombre' => 'Rene',
                'apellido_paterno' => 'Díaz',
                'apellido_materno' => null,
                'correo_electronico' => null,
                'telefono' => null,
                'fecha_registro' => now(),
                'estado' => 2
            ],
        ]);
    }
}
