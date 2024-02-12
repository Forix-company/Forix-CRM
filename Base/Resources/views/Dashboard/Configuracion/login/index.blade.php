@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{__('auth.title')}}</h2>
            <h5 class="text-white op-7 mb-2">{{__('auth.subtitle')}}</h5>
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
                                        <th>#</th>
                                        <th>{{__('auth.table.login')}}</th>
                                        <th>{{__('auth.table.option.auth')}}</th>
                                        <th>{{__('auth.table.status')}}</th>
                                        <th>{{__('auth.table.options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings_auth as $auth)
                                        <tr>
                                            <td>{{ $auth->id }}</td>
                                            <td>
                                                @if ($auth->id == 1)
                                                {{__('auth.table.login.auth.default')}}
                                                @endif
                                                @if ($auth->id == 2)
                                                {{__('auth.table.login.auth.2fa')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($auth->add_auth == 0)
                                                {{__('auth.table.option.disabled')}}
                                                @else
                                                {{__('auth.table.option.enabled')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($auth->status == 1)
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        {{__('auth.table.status.enabled')}}
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                        {{__('auth.table.status.disabled')}}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'route' => ['settings_auth', $auth->id]]) !!}
                                                {!! Form::hidden('estado', $auth->id, ['class' => 'form-control']) !!}
                                                {!! Form::submit(__('auth.button'), ['class' => 'btn btn-primary']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('configuracion') }}" class="btn btn-danger">{{__('button.back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
