<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_users')->insert([
            // SUPER ADMIN
            [
                'numcolaborador' => '250852',
                'nombres' => 'LUIS ANGEL',
                'apellidos' => 'ESPINOZA MAURO',
                'telefono' => '7291623408',
                'email_user' => 'luis.espinoza@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 1,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // ADMINISTRADOR
            [
                'numcolaborador' => '12345',
                'nombres' => 'ADMIN',
                'apellidos' => 'ADMIN',
                'telefono' => '0123456789',
                'email_user' => 'admin@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 2,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // USUARIO GUBERNAMENTAL
            [
                'numcolaborador' => '240389',
                'nombres' => 'ISAURA IVETTE',
                'apellidos' => 'HERNANDEZ BRAVO',
                'telefono' => '3331758127',
                'email_user' => 'isaura.hernandez@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 5,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // USUARIO DISTRIBUIDOR
            [
                'numcolaborador' => '230202',
                'nombres' => 'JORGE ISAAC',
                'apellidos' => 'SANCHEZ PEREZ',
                'telefono' => '3332013933',
                'email_user' => 'jorge.sanchez@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],

        ]);
    }
}
