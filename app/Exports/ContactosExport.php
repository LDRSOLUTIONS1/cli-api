<?php

namespace App\Exports;

use App\Models\Contacto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactosExport implements FromCollection, WithHeadings, WithMapping
{

    public function collection()
    {
        return Contacto::with([
            'cliente:id,nombre_comercial,razon_social',
            'puesto:id,nombre'
        ])
        ->where('estado','!=',0)
        ->get();
    }


    public function map($contacto): array
    {
        return [
            $contacto->id,
            $contacto->cliente?->nombre_comercial
                ?? $contacto->cliente?->razon_social,
            $contacto->puesto?->nombre,
            $contacto->nombre,
            $contacto->correo,
            $contacto->extension,
            $contacto->telefono,
            $contacto->estatus,
            optional($contacto->fecha_registro)->format('Y-m-d H:i:s'),
            $contacto->estado == 1 ? 'Inactivo':'Activo',
        ];
    }


    public function headings(): array
    {
        return [
            'ID',
            'CLIENTE',
            'PUESTO',
            'NOMBRE',
            'CORREO',
            'EXTENSION',
            'TELEFONO',
            'ESTATUS',
            'FECHA REGISTRO',
            'ESTADO'
        ];
    }
}
