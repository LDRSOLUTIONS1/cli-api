<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_regiones')->insert([
            [
                'id' => 1,
                'nombre' => 'Noroeste',
                'descripcion' => 'Baja California, Baja California Sur, Sonora, Sinaloa',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 2,
                'nombre' => 'Norte',
                'descripcion' => 'Chihuahua, Durango, Zacatecas',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 3,
                'nombre' => 'Noreste',
                'descripcion' => 'Coahuila, Nuevo León, Tamaulipas',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 4,
                'nombre' => 'Occidente',
                'descripcion' => 'Jalisco, Colima, Michoacán, Nayarit',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 5,
                'nombre' => 'Bajío',
                'descripcion' => 'Aguascalientes, Guanajuato, Querétaro, San Luis Potosí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 6,
                'nombre' => 'Centro',
                'descripcion' => 'CDMX, Estado de México, Hidalgo, Morelos, Puebla, Tlaxcala',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 7,
                'nombre' => 'Sur',
                'descripcion' => 'Guerrero, Oaxaca, Chiapas',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 8,
                'nombre' => 'Sureste',
                'descripcion' => 'Veracruz, Tabasco, Campeche, Yucatán, Quintana Roo',
                'fecha_registro' => now(),
                'estado' => 2
            ]
        ]);
    }
}
