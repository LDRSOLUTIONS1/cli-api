<?php

namespace App\Exports;

use App\Models\Contacto;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ContactosExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithColumnWidths,
    WithTitle
{
    public function collection()
    {
        return Contacto::with([
            'cliente:id,nombre_comercial,razon_social',
            'puesto:id,nombre'
        ])
            ->select(
                'id',
                'distribuidor_id',
                'puesto_id',
                'nombre',
                'correo',
                'telefono',
                'fecha_registro',
                'estado',
            )
            ->where('estado', '!=', 0)
            ->get();
    }


    public function map($contacto): array
    {
        $fecha = null;
        if ($contacto->fecha_registro) {
            try {
                $fecha = Carbon::parse($contacto->fecha_registro)->format('d/m/Y H:i:s');
            } catch (\Exception $e) {
                $fecha = $contacto->fecha_registro;
            }
        }

        return [
            $contacto->id,
            $contacto->distribuidor_id,
            $contacto->cliente?->nombre_comercial ?? $contacto->cliente?->razon_social ?? '—',
            $contacto->puesto_id,
            $contacto->puesto?->nombre ?? '—',
            $contacto->nombre,
            $contacto->correo ?? '—',
            $contacto->telefono ?? '—',
            $fecha ?? '—',
            $contacto->estado == 2 ? 'Activo' : ($contacto->estado == 1 ? 'Inactivo' : 'Eliminado'),
        ];
    }


    public function headings(): array

    {
        return [
            'ID',
            'CLIENTE_ID',
            'CLIENTE',
            'PUESTO_ID',
            'PUESTO',
            'NOMBRE',
            'CORREO',
            'TELÉFONO',
            'FECHA REGISTRO',
            'ESTATUS',
        ];
    }

    public function title(): string
    {
        return 'Contactos';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 30,
            'D' => 10,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,

        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastCol = 'J';

        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size'  => 11,
                'name'  => 'Arial',
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF1F3864'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(24);

        for ($row = 2; $row <= $lastRow; $row++) {
            $bgColor = ($row % 2 === 0) ? 'FFD9E1F2' : 'FFFFFFFF';

            $sheet->getStyle("A{$row}:{$lastCol}{$row}")->applyFromArray([
                'font' => [
                    'name' => 'Arial',
                    'size' => 10,
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => $bgColor],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);

            $sheet->getRowDimension($row)->setRowHeight(18);
        }

        $sheet->getStyle("A2:A{$lastRow}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("H2:H{$lastRow}")->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        for ($row = 2; $row <= $lastRow; $row++) {
            $cell  = $sheet->getCell("H{$row}");
            $value = $cell->getValue();

            $sheet->getStyle("H{$row}")->applyFromArray([
                'font' => [
                    'bold'  => true,
                    'color' => ['argb' => $value === 'Activo' ? 'FF1E7E34' : 'FF721C24'],
                    'size'  => 10,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ]);
        }

        $sheet->getStyle("A1:{$lastCol}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['argb' => 'FFBFBFBF'],
                ],
                'outline' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color'       => ['argb' => 'FF1F3864'],
                ],
            ],
        ]);

        $sheet->freezePane('A2');

        $sheet->setAutoFilter("A1:{$lastCol}1");

        return [];
    }
}
