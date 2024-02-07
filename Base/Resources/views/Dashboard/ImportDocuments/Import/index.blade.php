@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo De Importacion</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puedes Realizar cargas masivas</h5>
        </div>
    </div>
@endsection
@section('content')
    <div class="dropdown-divider"></div>
    <h1 style="text-align: center">EXPORTAR FORMATO</h1>
    <div class="dropdown-divider"></div>

    <div class="page-inner">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">EXPORTAR FORMATO PARA CATEGORIA</div>
                        <div class="card-category">formato de exportacion Excel</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.category') }}" class="btn btn-primary">Descargar Formato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">EXPORTAR FORMATO PARA ETIQUETAS</div>
                        <div class="card-category">formato de exportacion Excel</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.etiqueta') }}" class="btn btn-primary">Descargar Formato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">EXPORTAR FORMATO PARA FABRICANTE</div>
                        <div class="card-category">formato de exportacion Excel</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.factory') }}" class="btn btn-primary">Descargar Formato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">EXPORTAR FORMATO PARA PROVEEDORES</div>
                        <div class="card-category">formato de exportacion Excel</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.supplier') }}" class="btn btn-primary">Descargar Formato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-divider"></div>
    <h1 style="text-align: center">IMPORTAR DATOS</h1>
    <div class="dropdown-divider"></div>

    <div class="page-inner">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">IMPORTAR CATEGORIAS</div>
                        <div class="card-category">formato de importacion Excel</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.category', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Importar datos</label>
                                {!! Form::file('category', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Importar Formato', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">IMPORTAR ETIQUETAS</div>
                        <div class="card-category">formato de importacion Excel</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.etiqueta', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Importar datos</label>
                                {!! Form::file('etiqueta', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Importar Formato', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">IMPORTAR FABRICANTE</div>
                        <div class="card-category">formato de importacion Excel</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.factory', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Importar datos</label>
                                {!! Form::file('factory', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Importar Formato', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">IMPORTAR PROVEEDORES</div>
                        <div class="card-category">formato de importacion Excel</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.supplier', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Importar datos</label>
                                {!! Form::file('proveedor', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Importar Formato', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
