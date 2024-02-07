@extends('layout/plantilla')
@push('scripts')
    <script>
        var productos = []
        $(document).ready(function() {
            $('button.btn.btn-toggle.toggle-sidebar').click();
        });

        function seleccionarProducto(id) {
            var numero = $('#Nproductos').text();
            var resultado = parseInt(numero) + parseInt(id);
            $('#Nproductos').text(resultado);

            $.ajax({
                type: "POST",
                url: "pos/Detail/sale/" + id,
                data: {
                    _token: $('input[name="_token"]').val()
                },
                tryCount: 0,
                retryLimit: 3,
                success: function(response) {
                    var Subtotal = parseFloat($('#Subtotal').text().replace(/\$|,/g, ''))
                    var total = parseFloat(response['price'].replace(/\$|,/g, ''))
                    var resultado = Subtotal + total;
                    resultado = resultado.toLocaleString('en-US', {
                        style: 'currency',
                        currency: 'USD'
                    })
                    $('#Subtotal').text(resultado);
                    $('#total').text(resultado);
                    $('#list-price').append('<p>' + response['nombre'] + '</p>');

                },
                error: function(xhr, status, error) {
                    if (status === 'timeout') {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            $.ajax(this);
                            return;
                        }
                    }
                    alert("Ocurrió un error. Vuelva a intentarlo.", error);
                },
                timeout: 3000
            });
        }
    </script>
@endpush
@push('styles')
    <style>
        .scroll-container-products {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .scroll-container-list-price {
            max-height: 250px;
            width: 100%;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::token() !!}
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="scroll-container-products">
                                    <div class="row">
                                        @foreach ($Productos as $productos)
                                            <div class="col-sm-3 form-group">
                                                <div class="card" style="width: 10rem;"
                                                    onclick="seleccionarProducto({{ $productos->id }})">
                                                    <img src="{{ asset($productos->imagen) }}" class="card-img-top"
                                                        alt="Producto"
                                                        onerror="this.onerror=null; this.src='{{ asset('img/image-not-found.jpg') }}'"
                                                        width="90" height="90">
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $productos->name_products }}</p>
                                                        <a href="#" class="stretched-link"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <br>
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="row row-cols-2">
                                            <div class="col">N° de Productos</div>
                                            <div class="col" id="Nproductos">0</div>
                                            <div class="col">Sub total</div>
                                            <div class="col" id="Subtotal">{{ "$" . number_format(0, 2, '.', ',') }}
                                            </div>
                                            <div class="col">Descuento</div>
                                            <div class="col" id="Discount">{{ "$" . number_format(0, 2, '.', ',') }}
                                            </div>
                                            <div class="col">total</div>
                                            <div class="col" id="total">{{ "$" . number_format(0, 2, '.', ',') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row" style="height: 250px">
                                    <div class="scroll-container-list-price">
                                        <div id="list-price">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="button"
                                                    class="btn btn-danger btn-lg btn-block">Pagar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
