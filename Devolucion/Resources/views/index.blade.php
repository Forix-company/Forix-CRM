@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Devolucion Inventario</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Realizar Solicitud de Devolucion al proveedor</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" data-toggle="modal" data-target="#create" class="btn btn-danger btn-round">Crear Solicitud de
                Devolucion</a>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/devolucion/js/app.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title text-center">Total de Devoluciones del Inventario Al Proveedor</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>id</th>
                                        <th>proveedor</th>
                                        <th>producto</th>
                                        <th>cantidad</th>
                                        <th>observaciones</th>
                                        <th>estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($Devolucioninventario)
                                        @foreach ($Devolucioninventario as $Devolucion)
                                            <tr>
                                                <td>{{ $Devolucion->id }}</td>
                                                <td>{{ $Devolucion->name_supplier }}</td>
                                                <td>{{ $Devolucion->products }}</td>
                                                <td>{{ $Devolucion->quantity }}</td>
                                                <td>{{ $Devolucion->observations }}</td>
                                                <td>
                                                    @if ($Devolucion->name_state == 'Devolucion Por Garantia')
                                                        <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                            {{ $Devolucion->name_state }}
                                                        </div>
                                                    @else
                                                        <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                            Devuelven Productos por Garantia
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('devolucion.show', $Devolucion->id) }}"
                                                        class="btn btn-sm"><i class="fas fa-low-vision fa-2x"
                                                            style="color:#007bff"></i></a>
                                                    <a href="{{ route('devolucion.edit', $Devolucion->id) }}"
                                                        class="btn btn-sm"><i class="fas fa-pencil-alt fa-2x"
                                                            style="color:#ffc107"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['devolucion.destroy', $Devolucion->id]]) !!}
                                                    {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn
                                                    btn-sm',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="create">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">SOLICITUD DE DEVOLUCION DE GARANTIA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'devolucion', 'files' => true]) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <h3>INFORMACION DEL PRODUCTO </h3>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('seleccione el proveedor') !!} <span style="color: red">*</span>
                            <select name="proveedor" id="proveedor" class="form-control" required>
                                <option value="" selected disabled>seleccione el proveedor</option>
                                @foreach ($Proveedor as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->name_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('seleccione el producto') !!} <span style="color: red">*</span>
                            <select name="producto" id="producto" class="form-control" required>
                                <option value="" selected disabled>seleccione el producto</option>
                            </select>
                            <div id="ResponseProductUpdate"></div>
                        </div>
                        <div class="col-sm-3 form-group">
                            <div id="ResponseProductDetail"></div>
                        </div>
                        <div class="col-sm-3 form-group">
                            {!! Form::label('Digite la Cantidad') !!} <span style="color: red">*</span>
                            {!! Form::number('Cantidad', null, ['class' => 'form-control', 'min' => '0']) !!}
                        </div>
                        <div class="col-sm-3 form-group">
                            {!! Form::label('fecha de solicitud') !!}
                            {!! Form::date('solicitud', date('Y-m-d'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
                        </div>
                        <div class="col-sm-3 form-group">
                            {!! Form::label('Motivo de Devolucion') !!}
                            <select name="MotivoDevolucion" class="form-control" required>
                                <option value="" selected disabled>seleccione el producto</option>
                                @foreach ($MotivoDevolucion as $MDevolucion)
                                    <option value="{{ $MDevolucion->id }}">{{ $MDevolucion->name_state_inventory }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 form-group">
                            <div id="SoporteGarantia"></div>
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Observacion de la Devolucion') !!} <span style="color: red">*</span>
                            {!! Form::textarea('observacion', null, ['class' => 'form-control']) !!}
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
