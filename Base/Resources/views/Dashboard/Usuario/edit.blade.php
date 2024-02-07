@extends('layout/plantilla')
@push('scripts')
<script src="{{ asset('modules/base/js/user.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($User, ['method' => 'PATCH', 'route' => ['usuario.update', $User->id], 'files' => 'true']) !!}
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DEL USUARIOS </h1>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Nombre Completo') !!} <span style="color: red">*</span>
                                {!! Form::text('NombreCompleto', $User->name, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Foto Avatar') !!}
                                {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Correo Electronico') !!} <span style="color: red">*</span>
                                {!! Form::email('email', $User->email, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Contraseña') !!} <span style="color: red">*</span>
                                {!! Form::password('password', ['id'=>'password','class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Seleccione Cargo') !!} <span style="color: red">*</span>
                                <select name="user_id" class="form-control" required>
                                    <option value="" selected disabled>Seleccione un rol</option>
                                    <option value="1" @if ($User->user_id == 1) selected @endif>Administrador
                                    </option>
                                    <option value="2" @if ($User->user_id == 2) selected @endif>Supervisor
                                    </option>
                                    <option value="3" @if ($User->user_id == 3) selected @endif>Usuario
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Activar Autenticacion Doble Factor') !!}
                                {!! Form::select('login_2fa_statu', ['1' => 'Predeterminado', '2' => 'Autenticacion doble factor'], $User->login_2fa_statu, [
                                    'id' => 'login_2fa',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::hidden('', auth()->user()->id, ['class' => 'btn btn-primary','id' => 'user_id']) !!}
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ url('/') }}" class="btn btn-secondary">Volver al Inicio</a>
                                <a href="{{ route('usuario.index') }}" class="btn btn-danger">Ir a Usuarios</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showCodeQr" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-sm-12 form-group">
                            <h1 class="font-weight-bold">Autenticación con contraseña de un solo uso</h1>
                            <h2 class="font-weight-bold">Por favor escanear el Codigo QR</h2>
                        </div>
                        <div class="col-sm-12 form-group">
                            <div id="CodeQrStatus"></div>
                            <div id="CodeQr"></div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
