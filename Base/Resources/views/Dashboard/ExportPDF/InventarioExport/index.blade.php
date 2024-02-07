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
    <h3>TOTAL DE INVENTARIO HASTA EL DIA @php echo date('d-m-Y'); @endphp</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Codigo Producto</th>
                <th>Nombre Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Fecha Creacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reponse as $valor)
            <tr>
                <th>{{$valor->id}}</th>
                <td>{{$valor->code}}</td>
                <td>{{$valor->name_inventory}}</td>
                <td>{{$valor->stock}}</td>
                <td>{{$valor->supplier_price}}</td>
                <td>{{$valor->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
