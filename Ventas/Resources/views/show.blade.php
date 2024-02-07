@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo De Ventas</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puedes Visualizar las Ventas realizadas</h5>
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
                            <div class="col-sm-12 form-group text-center">
                                <h1 class="font-weight-bold">DETALLE DE LA VENTA</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Nombre del Cliente') !!}
                                {!! Form::text('', $DescripcionVentas->name_customer, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Producto Comprado') !!}
                                {!! Form::text('', $DescripcionVentas->products, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Cantidad') !!}
                                {!! Form::text('', $DescripcionVentas->quantity, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Metodo de pago') !!}
                                {!! Form::text('', $DescripcionVentas->PaymentMethod, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Precio') !!}
                                {!! Form::text('', $DescripcionVentas->price, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Descuento') !!}
                                {!! Form::text('', $DescripcionVentas->discount . '%', ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-12 form-group text-center">
                                <h2 class="font-weight-bold">ESTADO ACTUAL DEL PAGO</h2>
                                @if ($Pago)
                                    @switch($Pago->estadoTx)
                                        @case('Transacción aprobada')
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-check-circle fa-8x" style="color:green"></i>
                                                    </h5>
                                                    <h1 class="card-text">Transacción aprobada</h1>
                                                </div>
                                            </div>
                                        @break

                                        @case('Transacción rechazada')
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-times-circle fa-8x" style="color:red"></i>
                                                    </h5>
                                                    <h1 class="card-text">Transacción rechazada</h1>
                                                </div>
                                            </div>
                                        @break

                                        @case('Transacción pendiente')
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-exclamation-circle fa-8x" style="color:yellow"></i>
                                                    </h5>
                                                    <h1 class="card-text">Transacción pendiente</h1>
                                                </div>
                                            </div>
                                        @break

                                        @default
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-question-circle fa-8x" style="color:red"></i>
                                                    </h5>
                                                    <h1 class="card-text">Error Desconocida</h1>
                                                </div>
                                            </div>
                                    @endswitch
                                @else
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-check-circle fa-8x" style="color:green"></i>
                                        </h5>
                                        <h1 class="card-text">Pago En Efectivo</h1>
                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('ventas.index') }}" class="btn btn-danger">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
