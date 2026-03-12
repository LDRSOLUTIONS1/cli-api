<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RegionesSeeder::class,
            PaisesSeeder::class,
            EstadosSeeder::class,
            MunicipiosSeeder::class,
            DepartamentosSeeder::class,
            PuestosSeeder::class,
            TiposClientesSeeder::class,
            RegimenesFiscalesSeeder::class
        ]);
    }
}
