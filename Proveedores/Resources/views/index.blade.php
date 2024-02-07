@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Proveedores</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Proveedores</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <button class="btn btn-danger btn-round" data-toggle="modal" data-target="#createProveedor">Crear Usuario</button>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('modules/proveedores/js/app.js') }}"></script>
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
                                        <th>NIT</th>
                                        <th>Nombre Completo</th>
                                        <th>producto ofrecido</th>
                                        <th>direccion</th>
                                        <th>celular</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Proveedor as $proveedor)
                                        <tr>
                                            <td>{{ $proveedor->id }}</td>
                                            <td>{{ $proveedor->nit }}</td>
                                            <td>{{ $proveedor->name_supplier }}</td>
                                            <td>{{ $proveedor->product_offered }}</td>
                                            <td>{{ $proveedor->address }}</td>
                                            <td>{{ $proveedor->phone }}</td>
                                            <td>
                                                <a class="btn btn-sm"
                                                    href="{{ route('proveedor.show', $proveedor->id) }}"><i class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                                <a class="btn btn-sm"
                                                    href="{{ route('proveedor.edit', $proveedor->id) }}"><i class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['proveedor.destroy', $proveedor->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', ['type' => 'submit', 'class' => 'btn
btn-sm']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('configuracion') }}" class="btn btn-danger">Volver Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createProveedor" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR PROVEEDOR</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    {!! Form::open(['url' => 'proveedor', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="font-weight-bold">CREAR PROVEEDOR</h1>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Digite el nit') !!} <span style="color: red">*</span>
                            {!! Form::number('nit', 0, ['class' => 'form-control', 'required','pattern' => '[0-9]+','onKeyPress' => 'if(this.value.length==25) return false;']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Digite Nombre del proveedor') !!} <span style="color: red">*</span>
                            {!! Form::text('nombreProveedor', null, ['class' => 'form-control', 'maxlength' => 50, 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Correo Electronico') !!} <span style="color: red">*</span>
                            {!! Form::email('correo', null, ['class' => 'form-control', 'maxlength' => '30' ,'required']) !!}
                        </div>
                        <div class="col-sm-3 form-group">
                            {!! Form::label('Telefono') !!} <span style="color: red">*</span>
                            {!! Form::number('telefono', 0, ['class' => 'form-control', 'required','pattern' => '[0-9]+','onKeyPress' => 'if(this.value.length==15) return false;']) !!}
                        </div>
                        <div class="col-sm-3 form-group">
                            {!! Form::label('Celular') !!} <span style="color: red">*</span>
                            {!! Form::number('celular', 0, ['class' => 'form-control', 'required','pattern' => '[0-9]+','onKeyPress' => 'if(this.value.length==15) return false;']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Nombre del Producto Ofrecido') !!} <span style="color: red">*</span>
                            {!! Form::text('producto_ofrecido', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Adjuntar brochure o catalogo del proveedor') !!}
                            {!! Form::file('brochure', ['class' => 'form-control', 'accept' => '.pdf, .doc, .docx']) !!}
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Seleccione País / Región') !!}<span style="color: red">*</span>
                            <select class="selectpicker form-control" name="country" data-live-search="true" id="country"
                                required>
                                <option selected disabled>Seleccione el Pais</option>
                            </select>
                            <div id="updatesCountry"></div>
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Seleccione Departamento / Estado') !!}<span style="color: red">*</span>
                            <select class="selectpicker form-control" name="estado" data-live-search="true" id="estado"
                                required>
                                <option selected disabled>Seleccione Departamento</option>
                            </select>
                            <div id="UpdatesStatus"></div>
                        </div>
                        <div class="col-sm-4 form-group">
                            {!! Form::label('Seleccione Ciudad') !!}<span style="color: red">*</span>
                            <select class="selectpicker form-control" name="ciudad" data-live-search="true" id="ciudad"
                                required>
                                <option selected disabled>Seleccione Ciudad</option>
                            </select>
                            <div id="UpdatesCity"></div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <div id="direccion"></div>
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
