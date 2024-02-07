@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Empresa</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Informacion de su Empresa</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-danger btn-round" data-toggle="modal" data-target="#createBusiness">Crear
                Empresa</a>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('modules/empresas/js/app.js') }}"></script>
@endpush
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
                                        <th>#</th>
                                        <th>Nit</th>
                                        <th>Razon social</th>
                                        <th>Contacto</th>
                                        <th>Ubicacion</th>
                                        <th>Direccion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Empresa as $empresa)
                                        <tr>
                                            <td>{{ $empresa->id }}</td>
                                            <td>{{ $empresa->nit }}</td>
                                            <td>{{ $empresa->business_name }}</td>
                                            <td>{{ $empresa->mail }}</td>
                                            <td>{{ $empresa->country }} - {{ $empresa->department }} - {{ $empresa->city }}
                                            </td>
                                            <td>{{ $empresa->address }}</td>
                                            <td>
                                                <a class="btn btn-sm"
                                                    href="{{ route('empresa.edit', $empresa->id) }}">
                                                    <i class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['empresa.destroy', $empresa->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', ['type' => 'submit', 'class' => 'btn btn-sm']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('configuracion') }}" class="btn btn-danger">Volver Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createBusiness" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR EMPRESA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'empresa', 'files' => true]) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <h3>AGREGAR INFORMACION DE LA EMPRESA</h3>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('ingrese el nit') !!}<span style="color: red">*</span>
                            {!! Form::number('nit', 0, ['class' => 'form-control', 'min' => 0, 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('nombre de la razon social') !!}<span style="color: red">*</span>
                            {!! Form::text('business_name', null, ['maxlength' => 25,'class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('correo electronico de la empresa') !!}<span style="color: red">*</span>
                            {!! Form::email('mail', null, ['maxlength' => 50,'class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('logo empresa') !!}
                            {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Seleccione País / Región') !!}<span style="color: red">*</span>
                            <select class="selectpicker form-control" name="country" data-live-search="true" id="country"
                                required>
                                <option selected disabled>Seleccione el Pais</option>
                            </select>
                            <div id="updatesCountry"></div>
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Seleccione Departamento / Estado') !!}<span style="color: red">*</span>
                            <select class="selectpicker form-control" name="department" data-live-search="true" id="estado"
                                required>
                                <option selected disabled>Seleccione Departamento</option>
                            </select>
                            <div id="UpdatesStatus"></div>
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Seleccione Ciudad') !!}<span style="color: red">*</span>
                            <select class="selectpicker form-control" name="city" data-live-search="true" id="ciudad"
                                required>
                                <option selected disabled>Seleccione Ciudad</option>
                            </select>
                            <div id="UpdatesCity"></div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <div id="direccion"></div>
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
