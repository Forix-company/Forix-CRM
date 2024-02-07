<?php

namespace Modules\Base\Imports;

use Modules\Fabricante\Entities\Fabricantes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class FactoryImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Fabricantes([
            'nombre_fabricante' => $row['nombre_del_fabricante'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
