@extends('layout/plantilla')
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title text-center">Total de Devoluciones del Inventario Al Proveedor</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">DATOS DEVOLUCION DE INVENTARIO</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('seleccione el proveedor') !!} <span style="color: red">*</span>
                                <select name="proveedor" id="proveedor" class="form-control" required disabled>
                                    <option value="" selected disabled>seleccione el proveedor</option>
                                    @foreach ($Proveedor as $proveedor)
                                        <option value="{{ $proveedor->id }}"
                                            @if ($proveedor->name_supplier == $Devolucion->name_supplier) selected @endif>
                                            {{ $proveedor->name_supplier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('seleccione el producto') !!} <span style="color: red">*</span>
                                {!! Form::text('observacion', $Devolucion->products, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Digite la Cantidad') !!} <span style="color: red">*</span>
                                {!! Form::number('Cantidad', $Devolucion->quantity, ['class' => 'form-control', 'min' => '0', 'readonly']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Motivo de Devolucion') !!}
                                <select name="MotivoDevolucion" class="form-control" required disabled>
                                    <option value="" disabled>seleccione el producto</option>
                                    @foreach ($EstadoDevolucion as $Estado)
                                        <option value="{{ $Estado->id }}"
                                            @if ($Estado->name_state_inventory == $Devolucion->name_state_inventory) selected @endif>
                                            {{ $Estado->name_state_inventory }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($Devolucion->support_document)
                                <div class="col-sm-4 form-group">
                                    {!! Form::label('Adjuntar brochure o catalogo del proveedor', 'Adjuntar brochure o catalogo del proveedor') !!}
                                    <a href="{{ asset($Devolucion->support_document) }}" class="btn btn-primary"
                                        target="_blank">Visualizar el Soporte</a>
                                </div>
                            @else
                                <div class="col-sm-4 form-group">
                                    {!! Form::label('Adjuntar brochure o catalogo del proveedor', 'Adjuntar brochure o catalogo del proveedor') !!}
                                    <button disabled="disabled" class="btn btn-danger">No se Puede Visualizar el
                                        Soporte</button>
                                </div>
                            @endif
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Observacion de la Devolucion') !!} <span style="color: red">*</span>
                                {!! Form::textarea('observacion', $Devolucion->observations, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('devolucion.index') }}" class="btn btn-danger">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
