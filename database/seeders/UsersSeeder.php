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
            // ADMIN
            [
                'numcolaborador' => '12345',
                'nombres' => 'Admin',
                'apellidos' => 'Sistema',
                'telefono' => '5550000001',
                'email_user' => 'admin@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 1,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // USUARIOS DISTRIBUIDORES
            [
                'numcolaborador' => '54321',
                'nombres' => 'Pedro',
                'apellidos' => 'Lopez',
                'telefono' => '5550000002',
                'email_user' => 'pedro@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 2,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // USUARIOS GUBERNAMENTALES
            [
                'numcolaborador' => '98765',
                'nombres' => 'Ana',
                'apellidos' => 'Perez',
                'telefono' => '5550000007',
                'email_user' => 'ana@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 2,
                'fecha_registro' => now(),
                'estado' => 2
            ]

        ]);
    }
}
