<?php

namespace Modules\Base\Imports;

use Modules\Proveedores\Entities\Proveedor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Proveedor([
            'nit' => $row['nit'],
            'nombreProveedor' => $row['nombre_del_proveedor'],
            'correo' => $row['correo_del_proveedor'],
            'telefono' => $row['telefono_del_proveedor'],
            'celular' => $row['celular_del_proveedor'],
            'direccion' => $row['direccion'],
            'producto_ofrecido' => $row['producto_ofrecido'],
            'pais' => $row['pais_region'],
            'departamento' => $row['departamento_estado'],
            'ciudad' => $row['ciudad'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
