@extends('layout/plantilla')
@push('scripts')
<script src="{{ asset('modules/proveedores/js/app.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::model($proveedor, [
                            'method' => 'PATCH',
                            'route' => ['proveedor.update', $proveedor->id],
                            'files' => true,
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="font-weight-bold">ACTUALIZAR DATOS DEL PROVEEDOR</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Digite el nit', 'Digite el nit') !!} <span style="color: red">*</span>
                                {!! Form::number('nit', $proveedor->nit, ['class' => 'form-control', 'min' => '0', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Digite Nombre del proveedor', 'Digite Nombre del proveedor') !!} <span style="color: red">*</span>
                                {!! Form::text('nombreProveedor', $proveedor->name_supplier, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Correo Electronico', 'Correo Electronico') !!}
                                {!! Form::email('correo', $proveedor->email, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('Telefono', 'Telefono') !!}
                                {!! Form::number('telefono', $proveedor->phone, ['class' => 'form-control', 'min' => '0']) !!}
                            </div>
                            <div class="col-sm-3 form-group">
                                {!! Form::label('Celular', 'Celular') !!} <span style="color: red">*</span>
                                {!! Form::number('celular', $proveedor->cell_phone, ['class' => 'form-control', 'min' => '0', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Nombre del Producto Ofrecido', 'Nombre del Producto Ofrecido') !!} <span style="color: red">*</span>
                                {!! Form::text('producto_ofrecido', $proveedor->product_offered, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Adjuntar brochure o catalogo del proveedor', 'Adjuntar brochure o catalogo del proveedor') !!}
                                {!! Form::file('brochure', ['class' => 'form-control', 'accept' => '.pdf, .doc, .docx']) !!}
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione País / Región') !!}<span style="color: red">*</span>
                                <select class="selectpicker form-control" name="country" data-live-search="true"
                                    id="country" required>
                                    <option selected disabled>Seleccione el Pais</option>
                                </select>
                                <div id="updatesCountry"></div>
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione Departamento / Estado') !!}<span style="color: red">*</span>
                                <select class="selectpicker form-control" name="estado" data-live-search="true"
                                    id="estado" required>
                                    <option selected disabled>Seleccione Departamento</option>
                                </select>
                                <div id="UpdatesStatus"></div>
                            </div>
                            <div class="col-sm-4 form-group">
                                {!! Form::label('Seleccione Ciudad') !!}<span style="color: red">*</span>
                                <select class="selectpicker form-control" name="ciudad" data-live-search="true"
                                    id="ciudad" required>
                                    <option selected disabled>Seleccione Ciudad</option>
                                </select>
                                <div id="UpdatesCity"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <div id="direccion"></div>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a class="btn btn-danger" href="{{ route('proveedor.index') }}">Atras</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
