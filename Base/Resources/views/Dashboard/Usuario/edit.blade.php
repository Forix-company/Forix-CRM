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
                                <h1 class="font-weight-bold">{{__('user.edit.title')}}</h1>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.name')) !!} <span style="color: red">*</span>
                                {!! Form::text('NombreCompleto', $User->name, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.photo')) !!}
                                {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.email')) !!} <span style="color: red">*</span>
                                {!! Form::email('email', $User->email, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.pass')) !!} <span style="color: red">*</span>
                                {!! Form::password('password', ['id'=>'password','class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.Burden')) !!} <span style="color: red">*</span>
                                {!! Form::select(
                                    'user_id',
                                    ['' => 'Seleccione un rol', '1' => __('user.index.roles.admin'), '2' => __('user.index.roles.supervisor'), '3' => __('user.index.roles.user')],
                                    $User->user_id,
                                    ['class' => 'form-control', 'disabled'],
                                ) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label(__('user.index.create.user.method.active.auth')) !!}
                                {!! Form::select('login_2fa_statu', ['1' => __('user.index.create.user.method.active.auth.default'),
                                 '2' => __('user.index.create.user.method.active.auth.2fa')], $User->login_2fa_statu, [
                                    'id' => 'login_2fa',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::hidden('', auth()->user()->id, ['class' => 'btn btn-primary','id' => 'user_id']) !!}
                                {!! Form::submit(__('button.create'), ['class' => 'btn btn-primary']) !!}
                                <a href="{{ url('/') }}" class="btn btn-secondary">{{__('button.back.index')}}</a>
                                <a href="{{ route('usuario.index') }}" class="btn btn-danger">{{__('button.back.user')}}</a>
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
                            <h1 class="font-weight-bold">{{__('user.edit.qr.title')}}</h1>
                            <h2 class="font-weight-bold">{{__('user.edit.qr.subtitle')}}</h2>
                        </div>
                        <div class="col-sm-12 form-group">
                            <div id="CodeQrStatus"></div>
                            <div id="CodeQr"></div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('button.back')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
