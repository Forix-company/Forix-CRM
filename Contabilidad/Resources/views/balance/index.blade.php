@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Balance General</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total de Balance General</h5>
        </div>
    </div>
@endsection
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>id</th>
                                        <th>Dinero por ingresos</th>
                                        <th>Dinero por deuda</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Balance as $Bank)
                                        <tr>
                                            <td>{{ $Bank->id }}</td>
                                            <td>{{ $Bank->price_total_income }}</td>
                                            <td>{{ $Bank->price_total_expenses }}</td>
                                            <td>{{ $Bank->date_balance }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
