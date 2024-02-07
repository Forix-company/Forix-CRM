@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Total Gastos</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total Gastos</h5>
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
                                        <th>producto</th>
                                        <th>Concepto</th>
                                        <th>cantidad</th>
                                        <th>Valor</th>
                                        <th>Fecha de admision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gastos as $expenses)
                                        <tr>
                                            <td>{{ $expenses->id }}</td>
                                            <td>{{ $expenses->name_complete }}</td>
                                            <td>{{ $expenses->Concept }}</td>
                                            <td>{{ $expenses->quantity }}</td>
                                            <td>{{ "$" . number_format($expenses->Amount, 2, '.', ',') }}</td>
                                            <td>{{ $expenses->Dismissal_Date }}</td>
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
