@extends('layout/plantilla')
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">DATOS DEL PROVEEDOR</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Digite el nit', 'Digite el nit') !!}
                                {!! Form::number('nit', $proveedor->nit, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Digite Nombre del proveedor', 'Digite Nombre del proveedor') !!}
                                {!! Form::text('nombreProveedor', $proveedor->name_supplier, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Correo Electronico', 'Correo Electronico') !!}
                                {!! Form::email('correo', $proveedor->email, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('Telefono', 'Telefono') !!}
                                {!! Form::number('telefono', $proveedor->phone, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('Celular', 'Celular') !!}
                                {!! Form::number('celular', $proveedor->cell_phone, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Nombre del Producto Ofrecido', 'Nombre del Producto Ofrecido') !!}
                                {!! Form::text('producto_ofrecido', $proveedor->product_offered, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            @if ($proveedor->broucher)
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('Adjuntar brochure o catalogo del proveedor', 'Adjuntar brochure o catalogo del proveedor') !!}
                                    <a href="{{ asset($proveedor->broucher) }}" class="btn btn-primary"
                                        target="_blank">Visualizar el brochure</a>
                                </div>
                            @else
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('Adjuntar brochure o catalogo del proveedor', 'Adjuntar brochure o catalogo del proveedor') !!}
                                    <button disabled="disabled" class="btn btn-danger">No se Puede Visualizar el
                                        brochure</button>
                                </div>
                            @endif
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione País / Región') !!}
                                {!! Form::text('', $proveedor->country, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione Departamento / Estado') !!}
                                {!! Form::text('', $proveedor->department, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione Ciudad') !!}
                                {!! Form::text('', $proveedor->city, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Dirrecion del proveedor') !!}
                                {!! Form::text('', $proveedor->address, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                <a class="btn btn-danger" href="{{ route('proveedor.index') }}">Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
