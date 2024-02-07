@extends('layout/plantilla')
@push('scripts')
<script src="{{ asset('modules/empresas/js/app.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($empresa, ['method' => 'PATCH', 'route' => ['empresa.update', $empresa->id], 'files' => true]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DEL USUARIOS</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ingrese el nit') !!}<span style="color: red">*</span>
                                {!! Form::number('nit', null, ['class' => 'form-control', 'min' => '0', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('nombre de la razon social') !!}<span style="color: red">*</span>
                                {!! Form::text('business_name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('correo electronico de la empresa') !!}<span style="color: red">*</span>
                                {!! Form::email('mail', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('logo empresa') !!}
                                {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione País / Región') !!}<span style="color: red">*</span>
                                <select class="selectpicker form-control" name="country" data-live-search="true"
                                    id="country" required>
                                    <option selected disabled>Seleccione el Pais</option>
                                </select>
                                <div id="updatesCountry"></div>
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione Departamento / Estado') !!}<span style="color: red">*</span>
                                <select class="selectpicker form-control" name="department" data-live-search="true"
                                    id="estado" required>
                                    <option selected disabled>Seleccione Departamento</option>
                                </select>
                                <div id="UpdatesStatus"></div>
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione Ciudad') !!}<span style="color: red">*</span>
                                <select class="selectpicker form-control" name="city" data-live-search="true"
                                    id="ciudad" required>
                                    <option selected disabled>Seleccione Ciudad</option>
                                </select>
                                <div id="UpdatesCity"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <div id="direccion"></div>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a class="btn btn-danger" href="{{ route('empresa.index') }}">Atras</a>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
