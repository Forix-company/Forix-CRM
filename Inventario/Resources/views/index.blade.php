@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Inventario</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar,Exportar el Inventario Existente</h5>
        </div>
    </div>
@endsection
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title text-center">Total Inventario</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>id</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Inventario as $inventario)
                                        <tr>
                                            <td>{{ $inventario->id }}</td>
                                            <td>{{ $inventario->code }}</td>
                                            <td>{{ $inventario->name_inventory }}</td>
                                            <td>
                                                <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                    EN INVENTARIO
                                                </div>
                                            </td>
                                            <td>{{ $inventario->stock }}</td>
                                            <td>
                                                <a href="{{ route('inventario.show', $inventario->id ? $inventario->id : '0') }}"
                                                    class="btn btn-sm"><i class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                                <a href="{{ route('inventario.export.product', $inventario->id ? $inventario->id : '0') }}"
                                                    class="btn btn-sm"><i class="fas fa-file-download fa-2x" style="color:#007bff"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
