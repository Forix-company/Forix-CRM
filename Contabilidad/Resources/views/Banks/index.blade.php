@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Cuentas Bancarias</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total de Cuentas Bancarias</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" data-toggle="modal" data-target="#create" class="btn btn-danger btn-round">Crear Cuentas</a>
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
                        <div class="col-sm-12 alert alert-warning">
                            <h2>Nota :</h2>
                            <h4>Por favor ingrese una cuenta falsa para tener como referencia a nivel contable</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>id</th>
                                        <th>nombre banco</th>
                                        <th>tipo cuenta</th>
                                        <th>Valor</th>
                                        <th>Fecha creacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Bank_Accounts as $Bank)
                                        <tr>
                                            <td>{{ $Bank->id }}</td>
                                            <td>{{ $Bank->Bank_name }}</td>
                                            <td>{{ $Bank->Bank_type }}</td>
                                            <td>{{ "$" . number_format($Bank->balance, 2, '.', ',') }}</td>
                                            <td>{{ $Bank->created_at }}</td>
                                            <td>
                                                <a class="btn btn-sm"
                                                href="{{ route('contabilidad.show', $Bank->id) }}"><i class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                            <a class="btn btn-sm"
                                                href="{{ route('contabilidad.edit', $Bank->id) }}"><i class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['compras.destroy', $Bank->id]]) !!}
                                            {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', ['type' => 'submit', 'class' => 'btn
btn-sm']) !!}
                                            {!! Form::close() !!}
                                            </td>
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
                    <h1 class="modal-title">CREAR CUENTA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'contabilidad/cuentas']) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {!! Form::label('nombre banco', 'nombre Banco') !!}
                            {!! Form::text('Name_bank', null, ['class' => 'form-control', 'placeholder' => 'nombre del banco', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('tipo cuenta', 'tipo cuenta') !!}
                            {!! Form::select('Bank_type', ['ahorros' => 'Ahorros', 'corriente' => 'Corriente'], null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Ingrese el Valor', 'Ingrese el Valor') !!}
                            {!! Form::text('Total', null, [
                                'class' => 'form-control',
                                'id' => 'currency-field',
                                'pattern' => '^\$\d{1,3}(,\d{3})*(\.\d+)?$',
                                'data-type' => 'currency',
                                'placeholder' => '$1,000,000.00',
                                'required',
                            ]) !!}
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
