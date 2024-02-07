@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Cuentas Bancareas</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total de Cuentas Bancareas</h5>
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
                                        <th>nombre banco</th>
                                        <th>tipo cuenta</th>
                                        <th>Concepto</th>
                                        <th>Valor</th>
                                        <th>Fecha de admision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Transacciones as $Bank)
                                        <tr>
                                            <td>{{ $Bank->id }}</td>
                                            <td>{{ $Bank->Bank_name }}</td>
                                            <td>{{ $Bank->Bank_type }}</td>
                                            <td>{{ $Bank->Transaction_Type }}</td>
                                            <td>{{ "$" . number_format($Bank->Amount, 2, '.', ',') }}</td>
                                            <td>{{ $Bank->Transaction_Date }}</td>
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
