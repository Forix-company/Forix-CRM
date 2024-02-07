@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Total ingresos</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total ingresos</h5>
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
                                        <th>Cantidad</th>
                                        <th>Valor</th>
                                        <th>Fecha de admision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ingresos as $income)
                                        <tr>
                                            <td>{{ $income->id }}</td>
                                            <td>{{ $income->products }}</td>
                                            <td>{{ $income->Concept }}</td>
                                            <td>{{ $income->quantity }}</td>
                                            <td>{{ "$" . number_format($income->Amount, 2, '.', ',')}}</td>
                                            <td>{{ $income->Admission_date }}</td>
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
