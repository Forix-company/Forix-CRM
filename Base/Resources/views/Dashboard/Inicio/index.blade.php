@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{ __('welcome') }}</h2>
            <h5 class="text-white op-7 mb-2">{{ __('messages.welcome.subtitle') }}</h5>
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
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-clipboard-list fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.categorys') }}</h3>
                                        <a href="{{ url('categoria') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-tags fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.labels') }}</h3>
                                        <a href="{{ url('etiqueta') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-microchip fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.manufactory') }}</h3>
                                        <a href="{{ url('fabricante') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-cubes fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.prodcuts') }}</h3>
                                        <a href="{{ url('productos') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-dolly-flatbed fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.inventory') }}</h3>
                                        <a href="{{ url('inventario') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-dolly fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.return.inventory') }}</h3>
                                        <a href="{{ url('devolucion') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-clipboard-check fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.stadistics') }}</h3>
                                        <a href="{{ url('informes') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-chart-bar fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{ __('index.contability') }}</h3>
                                        <a href="{{ url('contabilidad/balance') }}" class="stretched-link"></a>
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
