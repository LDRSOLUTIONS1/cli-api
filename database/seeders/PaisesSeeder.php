<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_paises')->insert([
            'id'      => 1,
            'nombre'  => 'México',
            'codigo_iso'  => 'MX',
            
        ]);
    }
}
