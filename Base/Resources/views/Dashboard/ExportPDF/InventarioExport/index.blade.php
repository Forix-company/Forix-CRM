<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('pdf.inventory.export.navbar.title')}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <h3>{{__('pdf.inventory.export.title')}} @php echo date('d-m-Y'); @endphp</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>{{__('pdf.inventory.export.table.code')}}</th>
                <th>{{__('pdf.inventory.export.table.name')}}</th>
                <th>{{__('pdf.inventory.export.table.quantity')}}</th>
                <th>{{__('pdf.inventory.export.price')}}</th>
                <th>{{__('pdf.inventory.export.date')}}</th>
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
