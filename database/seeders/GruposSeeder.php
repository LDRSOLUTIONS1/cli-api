<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cli_grupos')->insert([
            ['codigo' => null, 'nombre' => 'ADACARI', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'ASTURCAR', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'B2WM', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'BOURS', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'BURK', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'CMV', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'DEL SURESTE', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'DERAS', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'EGD', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'ENERKOM', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'GRUMAR', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'HERMT', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'XIAN', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'JMC', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'PLASENCIA', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'POLICOM', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'POLICON', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'PREMIUM', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'R&R', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'RUANO', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'TANGAMANGA', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'VELCEN', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'JIMENEZ', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'MILENIO', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'ACC', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'ASIA-PACIFICO', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'EFICIENTES', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'CDC', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'EQUISOL', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'TAN', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'GRUVER', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'RIVERA', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'ZAPATA', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'ARTEC', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'CRUCES', 'descripcion' => null],
            ['codigo' => null, 'nombre' => 'JCMC', 'descripcion' => null],
        ]);
    }
}
