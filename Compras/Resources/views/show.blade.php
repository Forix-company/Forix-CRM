@extends('layout/plantilla')
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">DATOS DE LA COMPRA</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID de la Compra') !!}
                                {!! Form::number('codigo', $Compras->code, ['class' => 'form-control', 'min' => '0', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Tipo de Compra') !!} <span style="color: red">*</span>
                                {!! Form::text("TipoCompra", $ComprobanteCompra->voucher_name, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Seleccione Proveedor') !!} <span style="color: red">*</span>
                                {!! Form::text("Proveedor", $Proveedor->name_supplier, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Seleccione el Producto del proveedor') !!} <span style="color: red">*</span>
                                {!! Form::text("ProveedorProducto", $Compras->name_complete, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Estado de la Compra') !!} <span style="color: red">*</span>
                                {!! Form::text("ProveedorProducto", $EstadoCompraDefault->name_state_buys, ['class'=>'form-control', 'readonly']) !!}

                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Precio') !!} <span style="color: red">*</span>
                                {!! Form::text('Precio', $Compras->price, ['class' => 'form-control', 'id' => 'currency', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Total') !!} <span style="color: red">*</span>
                                {!! Form::text('Total', $Compras->total, ['class' => 'form-control', 'id' => 'total', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Cantidad') !!} <span style="color: red">*</span>
                                {!! Form::number('Cantidad', $Compras->quantity, [
                                    'class' => 'form-control',
                                    'min' => '0',
                                    'id' => 'cantidad',
                                    'readonly',
                                ]) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Descuento en % (porcentaje)') !!}
                                {!! Form::number('Descuento', $Compras->discount, [
                                    'class' => 'form-control',
                                    'min' => '0',
                                    'id' => 'Descuento',
                                    'readonly',
                                ]) !!}
                            </div>
                            @if ($Compras->broucher)
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('Visualizar Archivo Adjunto de soporte o brochure') !!}
                                    <a href="{{ asset($Compras->broucher) }}" class="btn btn-primary"
                                        target="_blank">Visualizar el brochure</a>
                                </div>
                            @else
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('Visualizar Archivo Adjunto de soporte o brochure') !!}
                                    <button disabled="disabled" class="btn btn-danger">No se Puede Visualizar el
                                        brochure</button>
                                </div>
                            @endif
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Observaciones en la Compra') !!}
                                {!! Form::textarea('Observaciones', $Compras->observations, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                <a class="btn btn-primary" href="{{ route('compras.index') }}">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
