<?php

namespace Modules\Base\Exports;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FactoryExport implements WithHeadings, WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre del Fabricante',
        ];
    }
}
