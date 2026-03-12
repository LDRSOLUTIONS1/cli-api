<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuestosSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_puestos')->insert([
            [
                'id' => 1,
                'departamento_id' => 1,
                'nombre' => 'Gerente General',
                'descripcion' => 'Gerente General',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 2,
                'departamento_id' => 2,
                'nombre' => 'Gerente Administrativo',
                'descripcion' => 'Gerente Administrativo',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 3,
                'departamento_id' => 2,
                'nombre' => 'Contador',
                'descripcion' => 'Contador',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 4,
                'departamento_id' => 2,
                'nombre' => 'Enlace Financiero',
                'descripcion' => 'Enlace Financiero',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 5,
                'departamento_id' => 3,
                'nombre' => 'Responsable de Sistemas',
                'descripcion' => 'Responsable de Sistemas',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 6,
                'departamento_id' => 4,
                'nombre' => 'Responsable de Marketing',
                'descripcion' => 'Responsable de Marketing',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 7,
                'departamento_id' => 5,
                'nombre' => 'Gerente Comercial',
                'descripcion' => 'Gerente Comercial',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 8,
                'departamento_id' => 5,
                'nombre' => 'Gerente de Ventas – Vehículos Comerciales',
                'descripcion' => 'Gerente de Ventas – Vehículos Comerciales',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 9,
                'departamento_id' => 5,
                'nombre' => 'Gerente de Ventas – Pick Ups & Vans',
                'descripcion' => 'Gerente de Ventas – Pick Ups & Vans',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 10,
                'departamento_id' => 6,
                'nombre' => 'Gerente / Responsable de Refacciones',
                'descripcion' => 'Gerente / Responsable de Refacciones',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 11,
                'departamento_id' => 7,
                'nombre' => 'Gerente / Responsable de Servicio',
                'descripcion' => 'Gerente / Responsable de Servicio',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 12,
                'departamento_id' => 7,
                'nombre' => 'Jefe de Taller',
                'descripcion' => 'Jefe de Taller',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 13,
                'departamento_id' => 1,
                'nombre' => 'Director General',
                'descripcion' => 'Director General',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'id' => 14,
                'departamento_id' => 1,
                'nombre' => 'Dueño',
                'descripcion' => 'Dueño / Propietario',
                'fecha_registro' => now(),
                'estado' => 2
            ],
        ]);
    }
}
