@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Cuentas por pagar</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total de Cuentas por pagar</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" data-toggle="modal" data-target="#create" class="btn btn-danger btn-round">Crear Cuentas por
                pagar</a>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('modules/contabilidad/js/app.js') }}"></script>
@endpush
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
                                        <th>nombre proveedor</th>
                                        <th>descripcion</th>
                                        <th>Valor</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AccountsPayable as $Bank)
                                        <tr>
                                            <td>{{ $Bank->id }}</td>
                                            <td>{{ $Bank->name_supplier }}</td>
                                            <td>{{ $Bank->description }}</td>
                                            <td>{{ "$" . number_format($Bank->AmountToPay, 2, '.', ',') }}</td>
                                            <td>{{ $Bank->created_at }}</td>
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

    <div class="modal fade" id="create" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR CUENTA POR PAGAR</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'contabilidad.AccountsPayable.store']) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <h3>AGREGAR INFORMACION DE LA CUENTA POR PAGAR</h3>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Seleccione el proveedor', 'Seleccione el proveedor') !!} <span style="color: red">*</span>
                            <select name="supplier" class="form-control" required>
                                @foreach ($supplier as $suppliers)
                                    <option value="" selected disabled>Seleccione una Opcion</option>
                                    <option value="{{ $suppliers->id }}">{{ $suppliers->name_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Seleccione la cuenta', 'Seleccione la cuenta') !!} <span style="color: red">*</span>
                            <select name="account" class="form-control" required>
                                @foreach ($Cuenta as $cuentas)
                                    <option value="" selected disabled>Seleccione una Opcion</option>
                                    <option value="{{ $cuentas->id }}">{{ $cuentas->Bank_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Total de deuda', 'Total de deuda') !!} <span style="color: red">*</span>
                            {!! Form::text('Precio', null, [
                                'class' => 'form-control',
                                'id' => 'currency-field',
                                'pattern' => '^\$\d{1,3}(,\d{3})*(\.\d+)?$',
                                'data-type' => 'currency',
                                'placeholder' => '$1,000,000.00',
                                'required',
                            ]) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Observacion', 'Observacion') !!} <span style="color: red">*</span>
                            {!! Form::textarea('observacion', null, ['class' => 'form-control', 'required',]) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
