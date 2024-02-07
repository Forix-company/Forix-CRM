@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Compras</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Ordenes de Compras</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" data-toggle="modal" data-target="#create" class="btn btn-danger btn-round">Crear Orden de
                Compras</a>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('modules/compras/js/app.js') }}"></script>
@endpush
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
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Autorizar o Denegar Compra</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Compras as $compras)
                                        <tr>
                                            <td>{{ $compras->id }}</td>
                                            <td>{{ $compras->name_complete }}</td>
                                            <td>{{ $compras->quantity }}</td>
                                            <td>{{ "$".number_format($compras->price, 2, '.', ',') }}</td>
                                            <td>
                                                @if ($compras->authorized_id === 1)
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        AUTORIZADO
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                        NO AUTORIZADO
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::model($compras, [
                                                    'method' => 'POST',
                                                    'route' => ['compras.Autorize', $compras->id],
                                                ]) !!}
                                                <select name="autorizacion" class="form-control">
                                                    @foreach ($EstadoCompraInventario as $estado)
                                                        <option value="{{ $estado->id }}">{{ $estado->name_state_inventory }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="cantidad" value="{{ $compras->quantity }}">
                                                <input type="hidden" name="precio" value="{{ $compras->total }}">
                                                {!! Form::submit('Validar', ['class' => 'btn btn-primary mt-1']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm"
                                                    href="{{ route('compras.show', $compras->id) }}"><i class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                                <a class="btn btn-sm"
                                                    href="{{ route('compras.edit', $compras->id) }}"><i class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['compras.destroy', $compras->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', ['type' => 'submit', 'class' => 'btn
btn-sm']) !!}
                                                {!! Form::close() !!}
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

    <div class="modal fade" id="create" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR COMPRA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'compras', 'files' => true]) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <h3>AGREGAR INFORMACION DE DE LA COMPRA</h3>
                        </div>
                        @isset($compras->code)
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('ID de la Compra') !!}
                                    {!! Form::number('codigo', $compras->code + 1, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                        @else
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID de la Compra') !!}
                                {!! Form::number('codigo', 1000000000, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        @endif
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Tipo de Compra') !!} <span style="color: red">*</span>
                            <select name="TipoCompra" class="form-control">
                                <option value="" selected disabled>Seleccione el Tipo de Compra</option>
                                @foreach ($ComprobanteCompra as $Comprobante)
                                    <option value="{{ $Comprobante->id }}">{{ $Comprobante->voucher_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Seleccione Proveedor') !!} <span style="color: red">*</span>
                            <select name="Proveedor" id="proveedor" class="form-control">
                                <option value="" selected disabled>Seleccione el Proveedor</option>
                                @foreach ($Proveedor as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->name_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Seleccione el Producto del proveedor') !!} <span style="color: red">*</span>
                            <select name="ProveedorProducto" id="TipoProducto" class="form-control">
                                <option value="" selected disabled>Seleccione el Producto</option>
                            </select>
                            <div id="ProveedorUpdate"></div>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Estado de la Compra') !!} <span style="color: red">*</span>
                            <select name="Estado" class="form-control">
                                @foreach ($EstadoCompraDefault as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->name_state_buys }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Precio Por Unidad') !!} <span style="color: red">*</span>
                            {!! Form::text('Precio', null, [
                                'class' => 'form-control',
                                'id' => 'currency-field',
                                'pattern' => '^\$\d{1,3}(,\d{3})*(\.\d+)?$',
                                'data-type' => 'currency',
                                'placeholder' => '$1,000,000.00',
                                'required',
                            ]) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Total') !!} <span style="color: red">*</span>
                            {!! Form::text('Total', null, ['class' => 'form-control', 'id' => 'total', 'readonly']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Cantidad') !!} <span style="color: red">*</span>
                            {!! Form::number('Cantidad', 0, ['class' => 'form-control', 'min' => '0', 'id' => 'cantidad', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Descuento en % (porcentaje)') !!}
                            {!! Form::number('Descuento', 0, ['class' => 'form-control', 'min' => '0', 'id' => 'Descuento']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Adjuntar Soporte de Compra (IMAGENES,PDF, WORD)') !!} <span style="color: red">*</span>
                            {!! Form::file('brochure', ['class' => 'form-control', 'accept' => '.jpg, .jpeg, .png, .pdf, .docx']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Observaciones en la Compra') !!}
                            {!! Form::textarea('Observaciones', null, ['class' => 'form-control']) !!}
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
