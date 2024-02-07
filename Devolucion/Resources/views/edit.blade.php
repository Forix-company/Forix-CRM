@extends('layout/plantilla')
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
                        {!! Form::model($Devolucion, [
                            'method' => 'PATCH',
                            'route' => ['devolucion.update', $Devolucion->id],
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">ACTUALIZAR DEVOLUCION DE INVENTARIO</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('seleccione el proveedor') !!} <span style="color: red">*</span>
                                <select name="Proveedor" class="form-control" readonly required>
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
                                {!! Form::text('Producto', $Devolucion->products, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Cantidad en devolucion') !!} <span style="color: red">*</span>
                                {!! Form::text('Stock', $Devolucion->quantity, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('fecha de solicitud') !!} <span style="color: red">*</span>
                                {!! Form::date('solicitud', date('Y-m-d'), ['class' => 'form-control', 'min' => date('Y-m-d'), 'required']) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('Motivo de Devolucion') !!} <span style="color: red">*</span>
                                <select name="MotivoDevolucion" id="MotivoDevolucionUpdate" class="form-control" required>
                                    <option value="" selected disabled>seleccione el producto</option>
                                    @foreach ($EstadoDevolucion as $Estado)
                                        <option value="{{ $Estado->id }}">{{ $Estado->name_state_inventory }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <div id="SoporteGarantia"></div>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('Observacion de la Devolucion') !!} <span style="color: red">*</span>
                                {!! Form::textarea('observacion', $Devolucion->observations, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('devolucion.index') }}" class="btn btn-danger">Atras</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
