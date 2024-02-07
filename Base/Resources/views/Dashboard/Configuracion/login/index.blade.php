@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Autenticacion</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Actualizar o Cambiar la Autenticacion de todos los usuarios
            </h5>
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
                                        <th>Sistema de Logueo</th>
                                        <th>Autenticacion Adicional</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings_auth as $auth)
                                        <tr>
                                            <td>{{ $auth->id }}</td>
                                            <td>
                                                @if ($auth->descriptions == 'Predeterminado')
                                                    Predeterminado
                                                @endif
                                                @if ($auth->descriptions == 'Predeterminado + Autenticacion doble factor')
                                                    Predeterminado + Autenticacion doble factor
                                                @endif
                                            </td>
                                            <td>
                                                @if ($auth->add_auth == 0)
                                                    No Habilitado
                                                @else
                                                    Habilitado
                                                @endif
                                            </td>
                                            <td>
                                                @if ($auth->status == 1)
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        ACTIVO
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                        DESACTIVAR
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'route' => ['settings_auth', $auth->id]]) !!}
                                                {!! Form::hidden('estado', $auth->id, ['class' => 'form-control']) !!}
                                                {!! Form::submit('ACTIVAR', ['class' => 'btn btn-primary']) !!}
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
@endsection
