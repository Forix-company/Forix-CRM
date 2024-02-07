@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo De Ventas</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puedes Enviar El correo Al cliente para realizar el pago con la
                pasarela de pago</h5>
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
                                <h1>Datos del cliente</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('NIT') !!}
                                {!! Form::text('', $Ventas->nit, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('nombre del cliente') !!}
                                {!! Form::text('', $Ventas->name_customer, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('correo electronico del cliente') !!}
                                {!! Form::text('', $Ventas->email, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('telefono del cliente') !!}
                                {!! Form::text('', $Ventas->phone, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('celular del cliente') !!}
                                {!! Form::text('', $Ventas->cell_phone, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-sm-12 form-group text-center">
                                <h1>Datos de la Compra</h1>
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('producto') !!}
                                {!! Form::text('', $Ventas->products, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('cantidad') !!}
                                {!! Form::text('', $Ventas->quantity, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('precio') !!}
                                {!! Form::text('', $Ventas->price, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        {!! Form::open(['url' => 'MetodoPago/send']) !!}
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Seleccione la pasarela de pago') !!} <span style="color: red">*</span>
                                <select name="pasarela" class="form-control" required>
                                    <option value="" selected disabled>Seleccione la pasarela de pago</option>
                                    @foreach ($Payment as $pasarela)
                                    <option value="{{$pasarela->NombreIniciales}}">{{$pasarela->NombrePasarela}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {!! Form::hidden('id', $id, ['class' => 'form-control']) !!}
                            {!! Form::hidden('correo', $Ventas->email, ['class' => 'form-control']) !!}
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Enviar Pago', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('ventas.index') }}" class="btn btn-danger">Atras</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
