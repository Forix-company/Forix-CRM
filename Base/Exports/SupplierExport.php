<?php

namespace Modules\Base\Exports;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierExport implements WithHeadings, WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 25,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            'NIT',
            'Nombre del Proveedor',
            'Correo del Proveedor',
            'Telefono del Proveedor',
            'Celular del Proveedor',
            'Direccion',
            'Producto Ofrecido',
            'País / Región',
            'Departamento / Estado',
            'Ciudad',
        ];
    }
}
