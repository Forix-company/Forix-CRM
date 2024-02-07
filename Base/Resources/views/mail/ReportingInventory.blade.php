<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de Inventario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Codigo Producto</th>
                <th>Nombre Producto</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Messaje as $users)
                <tr>
                    <th>{{ $users->id }}</th>
                    <td>{{ $users->code }}</td>
                    <td>{{ $users->name_inventory }}</td>
                    <td>{{ $users->description_products }}</td>
                    <td>{{ $users->quantities }}</td>
                    <td>{{ "$".number_format($users->price,2,'.',',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
