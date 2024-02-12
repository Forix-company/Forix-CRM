@extends('layout/plantilla')
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">DATOS DEL USUARIOS</h1>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            @if ($User->foto)
                                <div class="col-sm-12 text-center">
                                    <img src="{{ asset($User->foto) }}" alt="{{__('user.index.create.user.photo')}}" class="img-thumbnail" width="200"
                                        height="200">
                                </div>
                            @else
                                <div class="col-sm-12 text-center">
                                    <img src="{{ asset('img/avatar_default.png') }}" alt="{{__('user.index.create.user.photo')}}" width="150"
                                        height="150">
                                </div>
                            @endif
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.name')) !!}
                                {!! Form::text('Nombre', $User->name, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.email')) !!}
                                {!! Form::email('Nombre', $User->email, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.Burden')) !!}
                                {!! Form::select(
                                    'user_id',
                                    ['' => 'Seleccione un rol', '1' => __('user.index.roles.admin'), '2' => __('user.index.roles.supervisor'), '3' => __('user.index.roles.user')],
                                    $User->user_id,
                                    ['class' => 'form-control', 'disabled'],
                                ) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.method.auth')) !!}
                                @if ($User->login_2fa_statu == 0)
                                    {!! Form::text(null, 'Predeterminado', ['class' => 'form-control', 'readonly']) !!}
                                @else
                                    {!! Form::text(null, 'Autenticacion doble factor', ['class' => 'form-control', 'readonly']) !!}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <a href="{{ url('/') }}" class="btn btn-secondary">Volver al Inicio</a>
                                <a href="{{ route('usuario.index') }}" class="btn btn-danger">Ir a Usuarios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
