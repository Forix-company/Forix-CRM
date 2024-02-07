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
                                        <th>Nombre</th>
                                        <th>Incluye archivos</th>
                                        <th>Incluye base de datos</th>
                                        <th>Estado</th>
                                        <th>Fecha creacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($backups as $backup)
                                        <tr>
                                            <td>{{ $backup->id }}</td>
                                            <td>{{ $backup->name }}</td>
                                            <td>
                                                <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                    {{ $backup->folder }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                    {{ $backup->database }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($backup->status == 1)
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        ACTIVO
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                        INACTIVO
                                                    </div>
                                                @endif

                                            </td>
                                            <td>{{ $backup->date_create }}</td>
                                            <td><a href="{{ url('configuracion/descargar/copia',$backup->id) }}" target="_blank"
                                                    class="btn btn-primary">descargar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('configuracion') }}" class="btn btn-danger">Ir a Configuracion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
