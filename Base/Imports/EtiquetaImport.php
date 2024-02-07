<?php

namespace Modules\Base\Imports;

use Modules\Etiquetas\Entities\Etiquetas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class EtiquetaImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Etiquetas([
            'nombre_etiqueta' => $row['nombre_etiqueta'],
            'descripcion_etiqueta' => $row['descripcion_etiqueta'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
