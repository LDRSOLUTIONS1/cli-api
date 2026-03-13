<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_marcas')->insert([
            'id'      => 1,
            'nombre'  => 'Foton',
            'codigo'  => 'FOT',
            'fecha_registro' => now(),
            'estado' => 2
        ]);
    }
}
