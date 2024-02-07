@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Etiquetas</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Ordenes de Etiquetas</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-danger btn-round" data-toggle="modal" data-target="#create">Crear Etiquetas</a>
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
                                        <th>Nombre de la Categoria</th>
                                        <th>descripcion de la Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Etiqueta as $etiqueta)
                                        <tr>
                                            <td>{{ $etiqueta->id }}</td>
                                            <td>{{ $etiqueta->name_tags }}</td>
                                            <td>{{ $etiqueta->description_tags }}</td>
                                            <td>
                                                <a class="btn btn-sm" href="{{ route('etiqueta.edit', $etiqueta->id ) }}"><i class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['etiqueta.destroy', $etiqueta->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', ['type' => 'submit', 'class' => 'btn btn-sm']) !!}
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR ETIQUETA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'etiqueta']) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <h3>AGREGAR INFORMACION DEL ETIQUETA</h3>
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Nombre de la Etiqueta') !!}<span style="color: red">*</span>
                            {!! Form::text('name_tags', null, ['maxlength' => 20,'class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Descripcion de la Etiqueta') !!}<span style="color: red">*</span>
                            {!! Form::textarea('description_tags', null, ['class' => 'form-control', 'required']) !!}
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
