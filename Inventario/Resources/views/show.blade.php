@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Inventario</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Visualizar el Inventario Existente</h5>
        </div>
    </div>
@endsection
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Codigo</label>
                                {!! Form::text(null, $reponse->code, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nombre Producto</label>
                                {!! Form::text(null, $reponse->name_inventory, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Cantidad</label>
                                {!! Form::text(null, $reponse->stock, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Precio de Compra al proveedor</label>
                                {!! Form::text(null, number_format($reponse->price, 2, '.', ','), ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Precio total del Producto</label>
                                {!! Form::text(null, $reponse->supplier_price, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Estado del producto</label>
                                {!! Form::text(null, $reponse->name_state_buys, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <h3 class="font-weight-bold">DATOS DEL PROVEEDOR</h3>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nit</label>
                                {!! Form::text(null, $reponse->nit, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nombre Proveedor</label>
                                {!! Form::text(null, $reponse->name_supplier, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Telefono Proveedor</label>
                                {!! Form::text(null, $reponse->phone, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Celular Proveedor</label>
                                {!! Form::text(null, $reponse->cell_phone, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Direccion Proveedor</label>
                                {!! Form::text(null, $reponse->address, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-12  form-group">
                                <a href="{{ route('inventario.index') }}" class="btn btn-danger">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
