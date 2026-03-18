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
                'numcolaborador' => '11111',
                'nombres' => 'Carlos',
                'apellidos' => 'Ramírez Torres',
                'telefono' => '5550000001',
                'email_user' => 'carlos.ramirez@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 1,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // ADMINISTRADOR
            [
                'numcolaborador' => '22222',
                'nombres' => 'Laura',
                'apellidos' => 'Hernández López',
                'telefono' => '5550000002',
                'email_user' => 'laura.hernandez@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 2,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // USUARIO GUBERNAMENTAL
            [
                'numcolaborador' => '33333',
                'nombres' => 'Ana',
                'apellidos' => 'Pérez Gómez',
                'telefono' => '5550000003',
                'email_user' => 'ana.perez@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 5,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            // USUARIO DISTRIBUIDOR
            [
                'numcolaborador' => '44444',
                'nombres' => 'Pedro',
                'apellidos' => 'López Martínez',
                'telefono' => '5550000004',
                'email_user' => 'pedro.lopez@empresa.com',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
        ]);
    }
}
