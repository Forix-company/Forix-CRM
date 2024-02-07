@extends('layout/plantilla')
@push('scripts')
<script src="{{ asset('modules/productos/js/app.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($producto, [
                            'method' => 'PATCH',
                            'route' => ['productos.update', $producto->id],
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DEL PRODUCTOS</h1>
                            </div>
                            <div class="col-sm-12 form-group">
                                <img src="{{ asset($producto->imagen) }}" alt="Foto Producto" width="240" height="240">
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Codigo de producto') !!}
                                {!! Form::number('SKU', $producto->id, ['class' => 'form-control', 'min' => '0', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('foto de producto') !!}
                                {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Selecione la Categoria') !!}<span style="color: red">*</span>
                                <select name="categoria_id" class="form-control" required>
                                    <option value="" selected disabled>Seleccione Una Categoria</option>
                                    @foreach ($categoria as $Categoria)
                                        <option value="{{ $Categoria->id }}"
                                            @if ($producto->category_id == $Categoria->id) selected @endif>
                                            {{ $Categoria->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Selecione la Etiqueta') !!}<span style="color: red">*</span>
                                <select name="etiqueta_id" class="form-control" required>
                                    <option value="" selected disabled>Seleccione Una Etiqueta</option>
                                    @foreach ($etiqueta as $Etiqueta)
                                        <option value="{{ $Etiqueta->id }}"
                                            @if ($producto->tags_id == $Etiqueta->id) selected @endif>
                                            {{ $Etiqueta->name_tags }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Inventario Minimo') !!}<span style="color: red">*</span>
                                {!! Form::select(
                                    'inventarioMin',
                                    ['' => 'Seleccione Una Categoria', '5' => '5 Unidades', '10' => '10 Unidades', '20' => '20 Unidades'],
                                    $producto->inventory_id,
                                    ['class' => 'form-control', 'required'],
                                ) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Selecione Fabricante del producto') !!}<span style="color: red">*</span>
                                <select name="fabricante_id" class="form-control" required>
                                    <option value="" selected disabled>Seleccione Fabricante</option>
                                    @foreach ($fabricante as $Fabricante)
                                        <option value="{{ $Fabricante->id }}"
                                            @if ($producto->manufacturer_id == $Fabricante->id) selected @endif>
                                            {{ $Fabricante->name_manufacturer }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Nombre del Producto') !!}<span style="color: red">*</span>
                                {!! Form::text('NombreProducto', $producto->name_products, ['class' => 'form-control', 'readonly', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Descripcion del Producto') !!}<span style="color: red">*</span>
                                {!! Form::textarea('DescripcionProducto', $producto->description_products, [
                                    'class' => 'form-control',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('cantidad') !!}<span style="color: red">*</span>
                                {!! Form::number('cantidad', $producto->quantities, ['class' => 'form-control', 'min' => '0', 'required']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Precio') !!}<span style="color: red">*</span>
                                {!! Form::hidden('', '$'.number_format($producto->price, 2, ',', '.'), ['id' => 'PrecioCompra',]) !!}
                                {!! Form::text('precio', '$'.number_format($producto->price, 0, ',',','), [
                                    'class' => 'form-control',
                                    'id' => 'currency-field',
                                    'pattern' => '^\$\d{1,3}(,\d{3})*(\.\d+)?$',
                                    'data-type' => 'currency',
                                    'placeholder' => '$1,000,000.00',
                                    'required',

                                ]) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Estado del producto') !!}<span style="color: red">*</span>
                                <select name="estado_id" class="form-control" required>
                                    @foreach ($estado as $Estado)
                                        <option value="{{ $Estado->id }}">{{ $Estado->name_state_products }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('productos.index') }}" class="btn btn-danger">Atras</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
