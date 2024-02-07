@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo de Pasarelas de Pago</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Pasarelas de Pago</h5>
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
                    {!! Form::model($PayUConfiguration, [
                        'method' => 'PATCH',
                        'route' => ['payments.update', $PayUConfiguration->id],
                        'files' => true,
                    ]) !!}
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {!! Form::label('llave del api key') !!} <span style="color: red;">*</span>
                            {!! Form::text('ApiKey', $PayUConfiguration->ApiKey, ['class' => 'form-control','required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Id de la cuenta personal') !!} <span style="color: red;">*</span>
                            {!! Form::number('accountId', $PayUConfiguration->accountId, ['class' => 'form-control', 'min' => '0','required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Id del la cuenta comercial') !!} <span style="color: red;">*</span>
                            {!! Form::number('merchantId', $PayUConfiguration->merchantId, ['class' => 'form-control', 'min' => '0','required']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                           <a href="{{ route('payments.index') }}" class="btn btn-danger">atras</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
