@extends('layout/plantilla')
@push('scripts')
<script src="{{ asset('modules/compras/js/app.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($Compras, [
                            'method' => 'PATCH',
                            'route' => ['compras.update', $Compras->id],
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DE LA COMPRA</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID de la Compra') !!}
                                {!! Form::number('codigo', $Compras->code, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Tipo de Compra') !!} <span style="color: red">*</span>
                                <select name="TipoCompra" class="form-control">
                                    @foreach ($ComprobanteCompra as $Comprobante)
                                        <option value="{{ $Comprobante->id }}"
                                            @if ($Compras->voucher_id == $Comprobante->id) selected @endif>
                                            {{ $Comprobante->voucher_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Seleccione Proveedor') !!} <span style="color: red">*</span>
                                <select name="Proveedor" id="proveedor2" class="form-control">
                                    @foreach ($Proveedor as $proveedor)
                                        <option value="{{ $proveedor->id }}"
                                            @if ($Compras->supplier_id == $proveedor->id) selected @endif>
                                            {{ $proveedor->name_supplier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Seleccione el Producto del proveedor') !!} <span style="color: red">*</span>
                                <select name="ProveedorProducto" id="TipoProducto" class="form-control">
                                    @foreach ($Proveedor as $proveedor)
                                        <option value="{{ $proveedor->product_offered }}">
                                            {{ $proveedor->product_offered }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Estado De La Compra') !!} <span style="color: red">*</span>
                                <select name="Estado" class="form-control">
                                    @foreach ($EstadoCompraDefault as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->name_state_buys }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Precio') !!} <span style="color: red">*</span>
                                {!! Form::text('Precio', '$'.number_format($Compras->price, 2, '.', ','), [
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
                                {!! Form::text('Total','$'.number_format($Compras->total, 2, '.', ','), ['class' => 'form-control', 'id' => 'total', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Cantidad') !!} <span style="color: red">*</span>
                                {!! Form::number('Cantidad', $Compras->quantity, [
                                    'class' => 'form-control',
                                    'min' => '0',
                                    'id' => 'cantidad',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('Descuento en % (porcentaje)') !!}
                                {!! Form::number('Descuento', $Compras->discount, [
                                    'class' => 'form-control',
                                    'min' => '0',
                                    'id' => 'Descuento',
                                ]) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                @if ($Compras->authorized_id == 1)
                                    {!! Form::label('ESTADO DEL PRODUCTO') !!}
                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                        AUTORIZADO
                                        {!! Form::hidden('autorizacion', $Compras->authorized_id, ['class' => 'form-control']) !!}
                                    </div>
                                @else
                                    {!! Form::label('ESTADO DEL PRODUCTO') !!}
                                    <div class="badge badge-danger text-wrap" style="width: 6rem;">
                                        NO AUTORIZADO
                                        {!! Form::hidden('autorizacion', $Compras->authorized_id, ['class' => 'form-control']) !!}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Adjuntar Soporte de Compra (En Formato pdf y word)') !!} <span style="color: red">*</span>
                                {!! Form::file('brochure', ['class' => 'form-control', 'accept' => '.pdf, .doc, .docx', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Observaciones en la Compra') !!}
                                {!! Form::textarea('Observaciones', $Compras->observations, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a class="btn btn-danger" href="{{ route('compras.index') }}">Atras</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
