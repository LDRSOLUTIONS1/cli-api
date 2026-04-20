<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            RegionesSeeder::class,
            PaisesSeeder::class,
            EstadosSeeder::class,
            MunicipiosSeeder::class,
            DepartamentosSeeder::class,
            PuestosSeeder::class,
            TiposClientesSeeder::class,
            RegimenesFiscalesSeeder::class,
            MarcasSeeder::class,
            ModelosSeeder::class,
            GruposSeeder::class,
            RegionalesSeeder::class,
        ]);
    }
}
