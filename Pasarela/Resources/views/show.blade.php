@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo de Pasarelas de Pago</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar la Pasarelas de Pago</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-danger btn-round" data-toggle="modal" data-target="#create">Crear Pasarela</a>
        </div>
    </div>
@endsection
@section('content')
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {!! Form::label('llave del api key') !!}
                            {!! Form::text('', $PayUConfiguration->ApiKey, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Tipo de Modena') !!}
                            {!! Form::text('', $PayUConfiguration->currency, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Id de la cuenta personal') !!}
                            {!! Form::number('', $PayUConfiguration->accountId, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Id del la cuenta comercial') !!}
                            {!! Form::number('', $PayUConfiguration->merchantId, ['class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                           <a href="{{ route('payments.index') }}" class="btn btn-danger">atras</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
