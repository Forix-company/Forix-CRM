<?php

namespace Modules\Base\Imports;

use Modules\Categoria\Entities\Categoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new categoria([
            'nombre_categoria' => $row['nombre_categoria'],
            'descripcion_categoria' => $row['descripcion_categoria'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
