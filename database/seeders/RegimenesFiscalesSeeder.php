<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimenesFiscalesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cli_regimenes_fiscales')->insert([
            [
                'c_regimen_fiscal' => '601',
                'descripcion' => 'General de Ley Personas Morales',
                'persona_fisica' => 'No',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '603',
                'descripcion' => 'Personas Morales con Fines no Lucrativos',
                'persona_fisica' => 'No',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '605',
                'descripcion' => 'Sueldos y Salarios e Ingresos Asimilados a Salarios',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '606',
                'descripcion' => 'Arrendamiento',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '607',
                'descripcion' => 'Régimen de Enajenación o Adquisición de Bienes',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '608',
                'descripcion' => 'Demás ingresos',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '610',
                'descripcion' => 'Residentes en el Extranjero sin Establecimiento Permanente en México',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '611',
                'descripcion' => 'Ingresos por Dividendos (socios y accionistas)',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '612',
                'descripcion' => 'Personas Físicas con Actividades Empresariales y Profesionales',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '614',
                'descripcion' => 'Ingresos por intereses',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '615',
                'descripcion' => 'Régimen de los ingresos por obtención de premios',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '616',
                'descripcion' => 'Sin obligaciones fiscales',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '620',
                'descripcion' => 'Sociedades Cooperativas de Producción que optan por diferir sus ingresos',
                'persona_fisica' => 'No',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '621',
                'descripcion' => 'Incorporación Fiscal',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '622',
                'descripcion' => 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras',
                'persona_fisica' => 'No',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '623',
                'descripcion' => 'Opcional para Grupos de Sociedades',
                'persona_fisica' => 'No',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '624',
                'descripcion' => 'Coordinados',
                'persona_fisica' => 'No',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '625',
                'descripcion' => 'Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'No',
                'fecha_registro' => now(),
                'estado' => 2
            ],
            [
                'c_regimen_fiscal' => '626',
                'descripcion' => 'Régimen Simplificado de Confianza',
                'persona_fisica' => 'Sí',
                'persona_moral' => 'Sí',
                'fecha_registro' => now(),
                'estado' => 2
            ],
        ]);
    }
}
