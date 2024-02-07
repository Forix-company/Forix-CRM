<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura de Venta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    @foreach ($Empresas as $Empresa)
    <img src="{{ asset($Empresa->logo) }}" width="100" height="100" alt="Image no found">
@endforeach
    <!-- TITULO DE LA FACTURA DE VENTA --->
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>
                    <h1>RECIBO DE VENTA</h1>
                </th>
            </tr>
        </thead>
    </table>
    <div class="dropdown-divider"></div>
    <!-- INFORMACION DE LA EMPRESA --->
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID de factura</th>
                @foreach ($VentaDescripcion as $Descripcion)
                    <td>{{ $Descripcion->id_sales_check }}</td>
                @endforeach
            </tr>
            <tr>
                <th>NIT de Empresa</th>
                <th>Razon Social</th>
                <th>Direccion</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Empresas as $Empresa)
                <tr>
                    <td>{{ $Empresa->nit }}</td>
                    <td>{{ $Empresa->business_name }}</td>
                    <td>{{ $Empresa->address }}</td>
                    <td>{{ $Empresa->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="dropdown-divider"></div>
    <h4 style="text-align: center">Forma de pago</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Vendedor</th>
                <th>Forma de pago</th>
                <th>Fecha de Vencimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($VentaDescripcion as $Descripcion)
                <tr>
                    <td>{{ $Descripcion->name }}</td>
                    <td>{{ $Descripcion->PaymentMethod }}</td>
                    <td>@php echo date("d/m/Y"); @endphp</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="dropdown-divider"></div>
    <h4 style="text-align: center">Datos del Cliente</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>celular</th>
                <th>direccion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($VentaDescripcion as $Descripcion)
                <tr>
                    <td>{{ $Descripcion->name_customer }}</td>
                    <td>{{ $Descripcion->email }}</td>
                    <td>{{ $Descripcion->cell_phone }}</td>
                    <td>{{ $Descripcion->adress }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="dropdown-divider"></div>
    <h4 style="text-align: center">Descripcion de Compra</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Nombre Producto</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descuento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($VentaDescripcion as $Descripcion)
                <tr>
                    <td>{{ $Descripcion->id }}</td>
                    <td>{{ $Descripcion->products }}</td>
                    <td>{{ $Descripcion->observations }}</td>
                    <td>{{ $Descripcion->quantity }}</td>
                    <td>{{ "$".number_format($Descripcion->price, 2, '.', ',') }}</td>
                    <td>{{ $Descripcion->discount }} %</td>
                </tr>
            @endforeach
            <tr>
                <th>Total Items</th>
                <td colspan="3">
                    @foreach ($VentaDescripcion as $indexKey => $Descripcion)
                        {{ $loop->iteration }}
                    @endforeach
                </td>
                <th>Subtotal</th>
                @foreach ($VentaDescripcion as $Descripcion)
                    <td>{{ "$".number_format($Descripcion->price, 2, '.', ',') }}</td>
                @endforeach
            </tr>
            <tr>
                <th colspan="4"></th>
                <th>Total</th>
                @foreach ($VentaDescripcion as $Descripcion)
                    <td>{{ "$".number_format($Descripcion->price, 2, '.', ',') }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</body>

</html>
