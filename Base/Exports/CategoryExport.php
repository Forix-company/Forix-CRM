<?php

namespace Modules\Base\Exports;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements WithHeadings, WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre Categoria',
            'Descripcion Categoria',
        ];
    }
}
