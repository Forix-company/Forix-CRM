@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Contabilidad Cuentas Bancarias</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Total de Cuentas Bancarias</h5>
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
                    <div class="row">
                        <div class="col-sm-4">
                            {!! Form::label('nombre banco', 'nombre Banco') !!}
                            {!! Form::text('Name_bank', $Bank_Accounts->Bank_name, ['class' => 'form-control', 'placeholder' => 'nombre del banco', 'readonly']) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::label('tipo cuenta', 'tipo cuenta') !!}
                            {!! Form::select('Bank_type', ['ahorros' => 'Ahorros', 'corriente' => 'Corriente'], $Bank_Accounts->Bank_type, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::label('Ingrese el Valor', 'Ingrese el Valor') !!}
                            {!! Form::text('Total','$'.number_format($Bank_Accounts->balance, 2, '.', ','), [
                                'class' => 'form-control',
                                'id' => 'currency-field',
                                'pattern' => '^\$\d{1,3}(,\d{3})*(\.\d+)?$',
                                'data-type' => 'currency',
                                'placeholder' => '$1,000,000.00',
                                'readonly',
                            ]) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            <a class="btn btn-danger" href="{{ route('contabilidad.index') }}">Atras</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
