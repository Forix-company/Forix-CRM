@extends('layout/plantilla')
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($fabricante, [
                            'method' => 'PATCH',
                            'route' => ['fabricante.update', $fabricante->id],
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DEL FABRICANTE</h1>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Nombre del Fabricante') !!}<span style="color: red">*</span>
                                {!! Form::text('name_manufacturer',null, ['maxlength' => 20,'class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a class="btn btn-danger" href="{{ route('fabricante.index') }}">Atras</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
