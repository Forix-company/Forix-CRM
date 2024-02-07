@extends('layout/plantilla')
@push('scripts')
    <script src="{{ asset('modules/productos/js/app.js') }}"></script>
@endpush
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Productos</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Ordenes de Productos</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-danger btn-round" data-toggle="modal" data-target="#create">Crear Productos</a>
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
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Categoria / Etiqueta</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>{{ $producto->sku }}</td>
                                            <td>{{ $producto->name_products }}</td>
                                            <td>
                                                {{ $producto->name_category }}
                                                /-/
                                                {{ $producto->name_tags }}
                                            </td>
                                            <td>{{ $producto->quantities }}</td>
                                            <td>{{ '$' . number_format($producto->price, 2, '.', ',') }}</td>
                                            <td>
                                                @if ($producto->state_id == 1)
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        ACTIVO
                                                    </div>
                                                @elseif ($producto->state_id == 2)
                                                    <div class="badge badge-warning text-wrap" style="width: 6rem;">
                                                        SUSPENDIDO
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                                        CANCELADO
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm" href="{{ route('productos.show', $producto->id) }}"><i
                                                        class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                                <a class="btn btn-sm" href="{{ route('productos.edit', $producto->id) }}"><i
                                                        class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['productos.destroy', $producto->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-sm',
                                                ]) !!}
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
                    <h1 class="modal-title">CREAR PRODUCTOS</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'productos', 'files' => true]) !!}
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <h3>AGREGAR INFORMACION DE LOS PRODUCTOS</h3>
                        </div>
                        @isset($producto->sku)
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('Codigo de producto') !!}
                                    {!! Form::number('SKU', $producto->sku + 1, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                        @else
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Codigo de producto') !!}
                                {!! Form::number('SKU', 1000000000, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        @endif

                        <div class="col-sm-6 form-group">
                            {!! Form::label('foto de producto') !!}
                            {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Selecione el Producto') !!}<span style="color: red">*</span>
                            <select name="inventario_id" class="form-control" id="producto" required>
                                <option value="" selected disabled>Seleccione el Producto</option>
                                @foreach ($Inventario as $inventario)
                                    <option value="{{ $inventario->id }}">{{ $inventario->name_inventory }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Selecione la Categoria') !!}<span style="color: red">*</span>
                            <select name="categoria_id" class="form-control" required>
                                <option value="" selected disabled>Seleccione Una Categoria</option>
                                @foreach ($categoria as $Categoria)
                                    <option value="{{ $Categoria->id }}">{{ $Categoria->name_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Selecione la Etiqueta') !!}<span style="color: red">*</span>
                            <select name="etiqueta_id" class="form-control" required>
                                <option value="" selected disabled>Seleccione Una Etiqueta</option>
                                @foreach ($etiqueta as $Etiqueta)
                                    <option value="{{ $Etiqueta->id }}">{{ $Etiqueta->name_tags }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="DetailProduct"></div>
                    <div id="DetailProductUpdates"></div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Precio') !!}<span style="color: red">*</span>
                            {!! Form::text('precio', null, [
                                'class' => 'form-control',
                                'id' => 'currency-field',
                                'pattern' => '^\$\d{1,3}(,\d{3})*(\.\d+)?$',
                                'data-type' => 'currency',
                                'placeholder' => '$1,000,000.00',
                                'required',
                            ]) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Inventario Minimo') !!}<span style="color: red">*</span>
                            {!! Form::select(
                                'inventarioMin',
                                ['' => 'Seleccione Una Categoria', '5' => '5 Unidades', '10' => '10 Unidades', '20' => '20 Unidades'],
                                null,
                                ['class' => 'form-control', 'required'],
                            ) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Selecione Fabricante del producto') !!}<span style="color: red">*</span>
                            <select name="fabricante_id" class="form-control" required>
                                <option value="" selected disabled>Seleccione Fabricante</option>
                                @foreach ($fabricante as $Fabricante)
                                    <option value="{{ $Fabricante->id }}">{{ $Fabricante->name_manufacturer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <div id="ProductHTML"></div>
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('Descripcion del Producto') !!}<span style="color: red">*</span>
                            {!! Form::textarea('DescripcionProducto', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                        </div>
                        {!! Form::hidden('estado_id', 1, ['class' => 'form-control']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
