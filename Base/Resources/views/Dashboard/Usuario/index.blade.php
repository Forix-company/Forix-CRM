@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{__('user.index.title')}}</h2>
            <h5 class="text-white op-7 mb-2">{{__('user.index.subtitle')}}</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" data-toggle="modal" data-target="#create" class="btn btn-danger btn-round">{{__('user.index.create.title')}}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="page-inner mt--5">
        <div class="row row-card-no-pd mt--2">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{__('user.index.total')}}</p>
                                    <h4 class="card-title">{{ $Allusuarios }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{__('user.index.roles.admin')}}</p>
                                    <h4 class="card-title">{{ $administrador }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">{{__('user.index.roles.supervisor')}}</p>
                                    <h4 class="card-title">{{ $supervisor }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>{{__('user.index.table.id')}}</th>
                                        <th>{{__('user.index.table.name')}}</th>
                                        <th>{{__('user.index.table.email')}}</th>
                                        <th>{{__('user.index.table.burden')}}</th>
                                        <th>{{__('user.index.table.status')}}</th>
                                        <th>{{__('user.index.table.options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->name_roles }}</td>
                                            <td>
                                                @if ($usuario->blocked_temporarily === 0)
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        {{__('user.index.table.status.unlocked')}}
                                                    </div>
                                                @elseif ($usuario->blocked_temporarily === 1 && $usuario->blocked_permanently === 0)
                                                    <div class="badge badge-warning text-wrap" style="width: 6rem;">
                                                        {{__('user.index.table.status.locked.temp')}}
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger text-wrap" style="width: 7rem;">
                                                        {{__('user.index.table.status.locked')}}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('usuario.show', $usuario->id) }}" class="btn btn-sm">
                                                    <i class="fas fa-low-vision fa-2x" style="color: #007bff;" data-toggle="tooltip"
                                                    data-placement="top" title="{{__('user.index.table.options.show')}}"></i>
                                                </a>
                                                <a class="btn btn-sm" href="{{ route('usuario.edit', $usuario->id) }}">
                                                    <i class="fas fa-pencil-alt fa-2x" style="color:#ffc107" data-toggle="tooltip"
                                                    data-placement="top" title="{{__('user.index.table.options.edit')}}"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['usuario.destroy', $usuario->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545" data-toggle="tooltip" data-placement="top" title="'.__('user.index.table.options.delete').'"></i></i>', ['type' => 'submit', 'class' => 'btn btn-sm']) !!}
                                                {!! Form::close() !!}
                                                @if ($usuario->blocked_permanently === 1)
                                                    {!! Form::model($usuario, ['method' => 'PATCH', 'route' => ['unclock.users', $usuario->id]]) !!}
                                                    {!! Form::submit(__('user.index.table.options.unlock.user'), ['class' => 'btn btn-info mt-1']) !!}
                                                    {!! Form::close() !!}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('configuracion') }}" class="btn btn-danger">{{__('button.back.configuration')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    {!! Form::open(['url' => 'usuario', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="font-weight-bold">{{__('user.index.create.user.title')}}</h1>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label(__('user.index.create.user.name')) !!} <span style="color: red">*</span>
                            {!! Form::text('NombreCompleto', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label(__('user.index.create.user.Burden')) !!} <span style="color: red">*</span>
                            {!! Form::select(
                                'user_id',
                                ['' => 'Seleccione un rol', '1' => __('user.index.roles.admin'), '2' => __('user.index.roles.supervisor'), '3' => __('user.index.roles.user')],
                                null,
                                ['class' => 'form-control', 'required'],
                            ) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label(__('user.index.create.user.photo')) !!}
                            {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label(__('user.index.create.user.email')) !!} <span style="color: red">*</span>
                            {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label(__('user.index.create.user.pass')) !!} <span style="color: red">*</span>
                            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::submit(__('button.create'), ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('button.back')}}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
