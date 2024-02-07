@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo de Pasarelas de Pago</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Crear, Editar y Eliminar Pasarelas de Pago</h5>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-danger btn-round" data-toggle="modal" data-target="#create">Crear Pasarela</a>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#paymentPayU, #paymentEpayco').mouseenter(function() {
            $(this).addClass('hovered');
        }).mouseleave(function() {
            $(this).removeClass('hovered');
        }).click(function() {
            var selectedOption = $(this).data('valor');
            switch (selectedOption) {
                case "PayU":
                    $(this).toggleClass('active');
                    $('#PaymentGatewayPayU').show();
                    $('#PaymentGatewayEpayco').hide();
                    //$('#PaymentGatewayPayU').hide();

                    $('#account_id').prop('required', true);
                    $('#merchant_id').prop('required', true);

                    $('#PaymentGatewayEpayco, #paymentCobol').removeClass('active');
                    break;
                case "Epayco":
                    $(this).toggleClass('active');
                    $('#PaymentGatewayEpayco').show();
                    $('#PaymentGatewayPayU').hide();


                    $('#account_id').prop('required', false);
                    $('#merchant_id').prop('required', false);

                    $('#paymentPayU, #paymentCobol').removeClass('active');
                    break;
                case "PayU3":
                    $(this).toggleClass('active');
                    $('#PaymentGatewayPayU').hide();
                    $('#PaymentGatewayEpayco').hide();

                    $('#account_id').prop('required', false);
                    $('#merchant_id').prop('required', false);

                    $('#paymentPayU, #PaymentGatewayEpayco').removeClass('active');
                    break;
                default:
                    break;
            }
        });
    </script>
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
                                        <th>nombre pasarela</th>
                                        <th>id cuenta</th>
                                        <th>id comercio</th>
                                        <th>token pasarela</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($PayUConfiguration as $PayU)
                                        <tr>
                                            <td>{{ $PayU->id }}</td>
                                            <td>
                                                @if ($PayU->NombreIniciales == 'PayU')
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        {{ $PayU->NombrePasarela }}
                                                    </div>
                                                @elseif ($PayU->NombreIniciales == 'Epayco')
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        {{ $PayU->NombrePasarela }}
                                                    </div>
                                                @else
                                                    <div class="badge badge-success text-wrap" style="width: 6rem;">
                                                        Pasarela Externa
                                                    </div>
                                                @endif

                                            </td>
                                            <td>{{ $PayU->accountId }}</td>
                                            <td>{{ $PayU->merchantId }}</td>
                                            <td>{{ $PayU->ApiKey }}</td>
                                            <td>
                                                <a class="btn btn-sm"
                                                    href="{{ route('payments.show', $PayU->id) }}"><i class="fas fa-low-vision fa-2x" style="color:#007bff"></i></a>
                                                <a class="btn btn-sm"
                                                    href="{{ route('payments.edit', $PayU->id) }}"><i class="fas fa-pencil-alt fa-2x" style="color:#ffc107"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['payments.destroy', $PayU->id]]) !!}
                                                {!! Form::button('<i class="fas fa-trash fa-2x" style="color:#dc3545"></i>', ['type' => 'submit', 'class' => 'btn
btn-sm']) !!}
                                                {!! Form::close() !!}
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
    <div class="modal fade" id="create" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">CREAR PASARELA DE PAGO</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div id="OptionCliented" style="display: visible;">
                        <div class="row text-center">
                            <div class="col-sm-12 form-group">
                                <h2>SELECCIONE LA PASARELA DE PAGO A CONFIGURAR <span style="color: red">*</span></h2>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" id="paymentPayU" data-valor="PayU">
                                    <a href="#" class="stretched-link">
                                        <img src="{{ asset('img/PaymentGateway/PayU.svg') }}" width="250" height="200"
                                            class="card-img-top" alt="Image not found">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" id="paymentEpayco" data-valor="Epayco">
                                    <a href="#" class="stretched-link">
                                        <img src="{{ asset('img/PaymentGateway/epayco.svg') }}" width="250"
                                            height="200" class="card-img-top" alt="Image not found">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" id="paymentPayU" data-valor="PayU3">
                                    <a href="#" class="stretched-link">
                                        <img src="{{ asset('img/PaymentGateway/PayU.svg') }}" width="250" height="200"
                                            class="card-img-top" alt="Image not found">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="PaymentGatewayPayU" style="display: none;margin-bottom: 20px;">
                        {!! Form::open(['url' => 'configuracion/payments']) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group text-center">
                                <h1>CONFIGURACION DE PASARELA DE PAYU</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('URL de la pasarela') !!}
                                {!! Form::hidden('iniciales', 'PayU', ['class' => 'form-control']) !!}
                                {!! Form::hidden('pasarela', 'Pasarela PayU', ['class' => 'form-control']) !!}
                                {!! Form::text('URL', 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/', [
                                    'class' => 'form-control',
                                    'readonly',
                                ]) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Tipo de Modena') !!}
                                {!! Form::text('currency', 'COP', ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ApiKey de la cuenta de PayU') !!}
                                {!! Form::text('ApiKey', '4Vj8eK4rloUd272L48hsrarnUA', ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID de cuenta asignado por PayU') !!}
                                {!! Form::number('accountId', 512321, ['class' => 'form-control', 'id' => 'account_id']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID del comerciante asignado por PayU') !!}
                                {!! Form::number('merchantId', 508029, ['class' => 'form-control', 'id' => 'merchant_id']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::hidden('tax', 0, ['class' => 'form-control']) !!}
                                {!! Form::hidden('taxReturnBase', 0, ['class' => 'form-control']) !!}
                                {!! Form::hidden('test', 0, ['class' => 'form-control']) !!}
                                {!! Form::hidden(
                                    'responseUrl',
                                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                                        ? 'https://' . $_SERVER['HTTP_HOST'] . '/api/PaymentGateway/PayU'
                                        : 'http://' . $_SERVER['HTTP_HOST'] . '/api/PaymentGateway/PayU',
                                    ['class' => 'form-control'],
                                ) !!}
                            </div>
                            <div class="col-sm-12 text-center">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div id="PaymentGatewayEpayco" style="display: none;margin-bottom: 20px;">
                        {!! Form::open(['url' => 'configuracion/payments']) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group text-center">
                                <h1>CONFIGURACION DE PASARELA DE EPAYCO</h1>
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('URL de la pasarela') !!}
                                {!! Form::hidden('iniciales', 'Epayco', ['class' => 'form-control']) !!}
                                {!! Form::hidden('pasarela', 'Pasarela Epayco', ['class' => 'form-control']) !!}
                                {!! Form::text('URL', 'https://checkout.epayco.co/checkout.js', [
                                    'class' => 'form-control',
                                    'readonly',
                                ]) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('Tipo de Modena') !!}
                                {!! Form::text('currency', 'COP', ['class' => 'form-control', 'readonly']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ApiKey de la cuenta de Epayco') !!}
                                {!! Form::text('ApiKey', '4Vj8eK4rloUd272L48hsrarnUA', ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID de cuenta asignado por PayU') !!}
                                {!! Form::number('accountId', 512321, ['class' => 'form-control', 'id' => 'account_id']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('ID del comerciante asignado por PayU') !!}
                                {!! Form::number('merchantId', 508029, ['class' => 'form-control', 'id' => 'merchant_id']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::hidden('tax', 0, ['class' => 'form-control']) !!}
                                {!! Form::hidden('taxReturnBase', 0, ['class' => 'form-control']) !!}
                                {!! Form::hidden('test', 0, ['class' => 'form-control']) !!}
                                {!! Form::hidden(
                                    'responseUrl',
                                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                                        ? 'https://' . $_SERVER['HTTP_HOST'] . '/api/PaymentGateway/Epayco'
                                        : 'http://' . $_SERVER['HTTP_HOST'] . '/api/PaymentGateway/Epayco',
                                    ['class' => 'form-control'],
                                ) !!}
                            </div>
                            <div class="col-sm-12 text-center">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Atras</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            #paymentPayU:hover,
            #paymentPayU.active {
                background-color: lightgray;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            }

            #paymentEpayco:hover,
            #paymentEpayco.active {
                background-color: lightgray;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            }
        </style>
    @endpush
@endsection
