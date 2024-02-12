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
    <div class="text-center">
        <h2>{{__('pdf.reporting.title')}}</h2>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>{{__('pdf.reporting.table.code')}}</th>
                <th>{{__('pdf.reporting.table.name')}}</th>
                <th>{{__('pdf.reporting.table.desc')}}</th>
                <th>{{__('pdf.reporting.table.quantity')}}</th>
                <th>{{__('pdf.reporting.table.price')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Inventarios as $valor)
                <tr>
                    <th>{{ $valor->id }}</th>
                    <td>{{ $valor->code }}</td>
                    <td>{{ $valor->name_inventory }}</td>
                    <td>{{ $valor->description_products }}</td>
                    <td>{{ $valor->quantities }}</td>
                    <td>{{ "$ ".number_format($valor->price, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
