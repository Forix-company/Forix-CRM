@extends('layout/plantilla')
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($etiqueta, [
                            'method' => 'PATCH',
                            'route' => ['etiqueta.update', $etiqueta->id],
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DE LA ETIQUETA</h1>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Nombre de la Etiqueta') !!}<span style="color: red">*</span>
                                {!! Form::text('name_tags',null, ['maxlength' => 20,'class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Descripcion de la Etiqueta') !!}<span style="color: red">*</span>
                                {!! Form::textarea('description_tags',null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

