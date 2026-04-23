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

            // USUARIOS NUEVOS

            [
                'numcolaborador' => '250881',
                'nombres' => 'DULCE KARLA',
                'apellidos' => 'MONTERO JARAMILLO',
                'telefono' => null,
                'email_user' => 'dulce.montero@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 5,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '251021',
                'nombres' => 'JONATHAN',
                'apellidos' => 'GUERRERO SOTELO',
                'telefono' => null,
                'email_user' => 'jonathan.guerrero@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 5,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '250716',
                'nombres' => 'ISRAEL',
                'apellidos' => 'LOPEZ PADILLA',
                'telefono' => null,
                'email_user' => 'israel.lopez@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 5,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '240326',
                'nombres' => 'MARCO ANTONIO',
                'apellidos' => 'VASQUEZ MARTINEZ',
                'telefono' => null,
                'email_user' => 'marco.vasquez@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '250663',
                'nombres' => 'RENE',
                'apellidos' => 'DIAZ SANCHEZ',
                'telefono' => null,
                'email_user' => 'rene.diaz@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '240620',
                'nombres' => 'LUIS AXEL',
                'apellidos' => 'AGUILAR AREVALO',
                'telefono' => null,
                'email_user' => 'luis.aguilar@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '240585',
                'nombres' => 'SOFIA',
                'apellidos' => 'MENCHACA WIESBACH',
                'telefono' => null,
                'email_user' => 'sofia.menchaca@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '240522',
                'nombres' => 'AXEL',
                'apellidos' => 'GUZMAN VALLEJO',
                'telefono' => null,
                'email_user' => 'axel.guzman@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '230226',
                'nombres' => 'ARTURO DANIEL',
                'apellidos' => 'VARGAS MACIAS',
                'telefono' => null,
                'email_user' => 'arturo.vargas@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 6,
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'numcolaborador' => '230144',
                'nombres' => 'KARLA BERENICE',
                'apellidos' => 'ALDANA HERNANDEZ',
                'telefono' => null,
                'email_user' => 'karla.aldana@ldrsolutions.com.mx',
                'password' => Hash::make('password'),
                'rolid' => 4,
                'fecha_registro' => now(),
                'estado' => 2
            ],

        ]);
    }
}
