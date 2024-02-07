<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Venta</title>
    <style>
        body {
            padding-top: 5px;
            padding-bottom: 5px;
            font-family: monospace;
            text-align: center;
        }

        .invoice {
            width: 200px;
            margin: 0 auto;
            text-align: center;
        }

        .header {
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
            /* Centrar la tabla horizontalmente */
        }

        th,
        td {
            padding: 0px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="invoice">
        @foreach ($Empresas as $Empresa)
            <img src="{{ asset($Empresa->logo) }}" width="100" height="100" alt="Image no found">
        @endforeach
        <div class="header">TICKET DE VENTA</div>
        @foreach ($VentaDescripcion as $Descripcion)
            <div>Factura N°: {{ $Descripcion->id }}</div>
            <div>Codigo Factura: {{ $Descripcion->id_sales_check }}</div>
        @endforeach
        @foreach ($Empresas as $Empresa)
            <div>{{ $Empresa->razon_social }}</div>
            <div>NIT: {{ $Empresa->nit }}</div>
        @endforeach
        <div>---------------------------</div>
        @foreach ($VentaDescripcion as $Descripcion)
            <div>Cliente N°: {{ $Descripcion->name_customer }}</div>
            <div>Fecha: {{ $Descripcion->created_at }}</div>
        @endforeach
        <div>---------------------------</div>
        <table>
            <thead>
                <tr>
                    <th>Cant</th>
                    <th>Productos</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($VentaDescripcion as $Descripcion)
                    <tr>
                        <td>{{ $Descripcion->id }}</td>
                        <td>{{ $Descripcion->products }}</td>
                        <td>{{ "$" . number_format($Descripcion->price, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>---------------------------</div>
        <div class="header">Total $123,456</div>
        <div>---------------------------</div>
        <div>Gracias por su compra <br>
            Vuelva pronto</div>
    </div>
</body>

</html>
