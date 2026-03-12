<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    public function run()
    {
        $states = [

            ['id'=>1,'nombre'=>'Aguascalientes','region_id'=>5],
            ['id'=>2,'nombre'=>'Baja California','region_id'=>1],
            ['id'=>3,'nombre'=>'Baja California Sur','region_id'=>1],
            ['id'=>4,'nombre'=>'Campeche','region_id'=>8],
            ['id'=>5,'nombre'=>'Coahuila de Zaragoza','region_id'=>3],
            ['id'=>6,'nombre'=>'Colima','region_id'=>4],
            ['id'=>7,'nombre'=>'Chiapas','region_id'=>7],
            ['id'=>8,'nombre'=>'Chihuahua','region_id'=>2],
            ['id'=>9,'nombre'=>'Ciudad de México','region_id'=>6],
            ['id'=>10,'nombre'=>'Durango','region_id'=>2],
            ['id'=>11,'nombre'=>'Guanajuato','region_id'=>5],
            ['id'=>12,'nombre'=>'Guerrero','region_id'=>7],
            ['id'=>13,'nombre'=>'Hidalgo','region_id'=>6],
            ['id'=>14,'nombre'=>'Jalisco','region_id'=>4],
            ['id'=>15,'nombre'=>'Estado de México','region_id'=>6],
            ['id'=>16,'nombre'=>'Michoacán de Ocampo','region_id'=>4],
            ['id'=>17,'nombre'=>'Morelos','region_id'=>6],
            ['id'=>18,'nombre'=>'Nayarit','region_id'=>4],
            ['id'=>19,'nombre'=>'Nuevo León','region_id'=>3],
            ['id'=>20,'nombre'=>'Oaxaca','region_id'=>7],
            ['id'=>21,'nombre'=>'Puebla','region_id'=>6],
            ['id'=>22,'nombre'=>'Querétaro','region_id'=>5],
            ['id'=>23,'nombre'=>'Quintana Roo','region_id'=>8],
            ['id'=>24,'nombre'=>'San Luis Potosí','region_id'=>5],
            ['id'=>25,'nombre'=>'Sinaloa','region_id'=>1],
            ['id'=>26,'nombre'=>'Sonora','region_id'=>1],
            ['id'=>27,'nombre'=>'Tabasco','region_id'=>8],
            ['id'=>28,'nombre'=>'Tamaulipas','region_id'=>3],
            ['id'=>29,'nombre'=>'Tlaxcala','region_id'=>6],
            ['id'=>30,'nombre'=>'Veracruz de Ignacio de la Llave','region_id'=>8],
            ['id'=>31,'nombre'=>'Yucatán','region_id'=>8],
            ['id'=>32,'nombre'=>'Zacatecas','region_id'=>2],

        ];

        foreach ($states as $state) {
            DB::table('cli_estados')->insert([
                'id' => $state['id'],
                'nombre' => $state['nombre'],
                'pais_id' => 1,
                'region_id' => $state['region_id'],
                'fecha_registro' => now(),
                'estado' => 2
            ]);
        }
    }
}
