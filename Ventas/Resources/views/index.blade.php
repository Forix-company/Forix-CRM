@extends('layout/plantilla')
@push('scripts')
    <script src="{{ asset('modules/ventas/js/app.js') }}"></script>
@endpush
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo De Ventas</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puedes Visualizar las Ventas realizadas</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="{{ route('ventas.pos') }}" class="btn btn-danger btn-round">Ingresar al POS</a>
            <a href="#" data-toggle="modal" data-target="#createSales" class="btn btn-danger btn-round">Crear Venta</a>
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
                                        <th>Nombre Del Cliente</th>
                                        <th>producto ofrecido</th>
                                        <th>Descripcion</th>
                                        <th>precio</th>
                                        <th>Medio de Pago</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Ventas as $venta)
                                        <tr>
                                            <td>{{ $venta->id }}</td>
                                            <td>{{ $venta->name_customer }}</td>
                                            <td>{{ $venta->name_products }}</td>
                                            <td>{{ $venta->description_products }}</td>
                                            <td>{{ "$" . number_format($venta->price, 2, '.', ',') }}</td>
                                            <td>
                                                <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                    {{ $venta->PaymentMethod }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($venta->name_customer != 'Cliente anonimo' && $venta->PaymentMethod == 'PSE (Pago Seguro en Línea)')
                                                    @if ($EstadoVentaOnline)
                                                        @switch($EstadoVentaOnline->NombreIniciales)
                                                            @case('PayU')
                                                                <a class="btn btn-sm"
                                                                    href="{{ url('PaymentGateway/voucher/PayU/' . $EstadoVentaOnline->merchantId . '') }}"
                                                                    target="_blank"><i class="fas fa-desktop fa-2x"
                                                                        style="color:#007bff"></i></a>
                                                                <a class="btn btn-sm"
                                                                    href="{{ route('ventas.show', $venta->id) }}"><i
                                                                        class="fas fa-low-vision fa-2x"
                                                                        style="color:#007bff"></i></a>
                                                                <a class="btn btn-sm"
                                                                    href="{{ route('get.sale.detail.pdf', $venta->id ? $venta->id : '0') }}"
                                                                    target="_blank"><i class="fas fa-file-pdf fa-2x"
                                                                        style="color:#007bff"></i></a>
                                                                <a class="btn btn-sm"
                                                                    href="{{ route('get.sale.detail.ticket.pdf', $venta->id ? $venta->id : '0') }}"
                                                                    target="_blank">
                                                                    <i class="fas fa-receipt fa-2x" style="color:#007bff"></i>
                                                                </a>
                                                            @break

                                                            @case('Epayco')
                                                                <a class="btn btn-sm"
                                                                    href="{{ url('PaymentGateway/voucher/Epayco/' . $EstadoVentaOnline->merchantId . '') }}"
                                                                    target="_blank"><i class="fas fa-desktop fa-2x"
                                                                        style="color:#007bff"></i></a>
                                                                <a class="btn btn-sm"
                                                                    href="{{ route('ventas.show', $venta->id) }}"><i
                                                                        class="fas fa-low-vision fa-2x"
                                                                        style="color:#007bff"></i></a>
                                                                <a class="btn btn-sm"
                                                                    href="{{ route('get.sale.detail.pdf', $venta->id ? $venta->id : '0') }}"
                                                                    target="_blank"><i class="fas fa-file-pdf fa-2x"
                                                                        style="color:#007bff"></i></a>
                                                                <a class="btn btn-sm"
                                                                    href="{{ route('get.sale.detail.ticket.pdf', $venta->id ? $venta->id : '0') }}"
                                                                    target="_blank">
                                                                    <i class="fas fa-receipt fa-2x" style="color:#007bff"></i>
                                                                </a>
                                                            @break
                                                        @endswitch
                                                    @else
                                                        <a class="btn btn-sm"
                                                            href="{{ route('ventas.send', $venta->id) }}">
                                                            <i class="fas fa-money-bill fa-2x"
                                                                style="color:#007bff"></i></a>
                                                        <a class="btn btn-sm"
                                                            href="{{ route('ventas.show', $venta->id) }}"><i
                                                                class="fas fa-low-vision fa-2x"
                                                                style="color:#007bff"></i></a>
                                                        <a class="btn btn-sm"
                                                            href="{{ route('get.sale.detail.pdf', $venta->id ? $venta->id : '0') }}"
                                                            target="_blank"><i class="fas fa-file-pdf fa-2x"
                                                                style="color:#007bff"></i></a>
                                                    @endif
                                                @else
                                                    <a class="btn btn-sm" href="{{ route('ventas.show', $venta->id) }}"><i
                                                            class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                                    <a class="btn btn-sm"
                                                        href="{{ route('get.sale.detail.pdf', $venta->id ? $venta->id : '0') }}"
                                                        target="_blank"><i class="fas fa-file-pdf fa-2x"
                                                            style="color:#007bff"></i>
                                                    </a>
                                                    <a class="btn btn-sm"
                                                        href="{{ route('get.sale.detail.ticket.pdf', $venta->id ? $venta->id : '0') }}"
                                                        target="_blank"><i class="fas fa-receipt fa-2x"
                                                            style="color:#007bff"></i>
                                                    </a>
                                                @endif

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

    <div class="modal fade" id="createSales" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR VENTA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'ventas']) !!}
                    <div id="OptionCliente" style="display: visible;">
                        <div class="row text-center">
                            <div class="col-sm-12 form-group">
                                <h1 class="font-weight-bold">Datos del Clientes</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                <h2>TIENE LOS DATOS BASICOS DEL CLIENTE <span style="color: red">*</span></h2>
                            </div>
                            <div class="col-sm-6 form-group">
                                <select name="Verificacion" id="conditionBuy" class="form-control" required>
                                    <option value="">Seleccione una Opcion</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="ShowDetailCliente" style="display: none;">
                        <div class="row text-center">
                            <div class="col-sm-12">
                                <h1 class="font-weight-bold">Datos del Clientes</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Nit') !!} <span style="color: red">*</span>
                                {!! Form::number('nit', 0, ['class' => 'form-control', 'id' => 'nit']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Nombre Completo del CLiente') !!} <span style="color: red">*</span>
                                {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'nombre']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('correo electrónico') !!} <span style="color: red">*</span>
                                {!! Form::email('correo', null, ['class' => 'form-control', 'id' => 'correo']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('telefono') !!} <span style="color: red">*</span>
                                {!! Form::number('telefono', 0, ['class' => 'form-control', 'min' => 0, 'id' => 'telefono']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('celular') !!} <span style="color: red">*</span>
                                {!! Form::number('celular', 0, ['class' => 'form-control', 'min' => 0, 'id' => 'celular']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('pais') !!} <span style="color: red">*</span>
                                <select class="selectpicker form-control" name="country" data-live-search="true"
                                    id="country">
                                    <option selected disabled>Seleccione el Pais</option>
                                </select>
                                <div id="updatesCountry"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('departamento') !!} <span style="color: red">*</span>
                                <select class="selectpicker form-control" name="estado" data-live-search="true"
                                    id="estado">
                                    <option selected disabled>Seleccione Departamento</option>
                                </select>
                                <div id="UpdatesStatus"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ciudad') !!} <span style="color: red">*</span>
                                <select class="selectpicker form-control" name="ciudad" data-live-search="true"
                                    id="ciudad">
                                    <option selected disabled>Seleccione Ciudad</option>
                                </select>
                                <div id="UpdatesCity"></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <div id="direccion"></div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row text-center">
                        <div class="col-sm-12 form-group">
                            <h1 class="font-weight-bold">Datos De la Venta</h1>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Tipo de Comprobante') !!} <span style="color: red">*</span>
                            <select name="TipoComprobante" class="form-control" required>
                                <option value="" selected disabled>Seleccione una Opcion</option>
                                @foreach ($ComprobanteVentas as $Comprobante)
                                    <option value="{{ $Comprobante->id }}">{{ $Comprobante->name_receipt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Seleccione el Productos') !!} <span style="color: red">*</span>
                            <select name="Productos" id="productoVenta"class="form-control" required>
                                <option value="" selected disabled>Seleccione una Opcion</option>
                                @foreach ($Productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->name_products }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="DetailProduct"></div>
                    <div id="DetailProductUpdates"></div>
                    <div class="row text-center">
                        <div class="col-sm-3 form-group">
                            {!! Form::label('Medio de Pago') !!} <span style="color: red">*</span>
                            <select name="MetodoPago" id="PaymentMethodCondition" class="form-control" required>
                                <option value="" selected disabled>Seleccione el Metodo de Pago</option>
                                @foreach ($MetodoPago as $pago)
                                    <option value="{{ $pago->id }}">{{ $pago->PaymentMethod }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            {!! Form::label('estado de la venta') !!} <span style="color: red">*</span>
                            <select name="estado" class="form-control" required>
                                @foreach ($EstadoVentas as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->name_state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Cantidad a la venta') !!} <span style="color: red">*</span>
                            {!! Form::number('Cantidad', 0, ['class' => 'form-control', 'id' => 'cantidad', 'min' => '0', 'required']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Descuento en % (porcentaje)') !!}
                            {!! Form::number('Descuento', 0, ['class' => 'form-control', 'min' => '0', 'id' => 'Descuento']) !!}
                        </div>
                        <div class="col-sm-6 form-group">
                            {!! Form::label('Total') !!} <span style="color: red">*</span>
                            {!! Form::text('Total', null, ['class' => 'form-control', 'id' => 'total', 'readonly']) !!}
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::label('observaciones') !!}
                            {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="miModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">ERROR PAGO EN LINEA</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <li class="fas fa-times-circle fa-8x" style="color:red"></li>
                        </div>
                        <div class="col-sm-12 form-group">
                            <p>No puede asignar un pago en linea sin los datos del cliente</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
