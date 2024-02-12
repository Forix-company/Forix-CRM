@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{__('welcome')}}</h2>
            <h5 class="text-white op-7 mb-2">{{__('messages.welcome.subtitle')}}</h5>
        </div>
    </div>
@endsection
@php
    $activeModules = Module::allEnabled();
@endphp
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
                                            <i class="fas fa-users fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{__('index.users')}}</h3>
                                        <a href="{{ url('usuario') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            @foreach ($activeModules as $module)
                                @switch($module->getName())
                                    @case('Proveedores')
                                        <div class="col-sm-3 form-group">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-truck-loading fa-6x" style="color:#007bff"></i>
                                                    </h5>
                                                    <h3 class="card-text">{{__('index.supplier')}}</h3>
                                                    <a href="{{ route('proveedor.index') }}" class="stretched-link"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @break

                                    @case('Empresas')
                                        <div class="col-sm-3 form-group">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-building fa-6x" style="color:#007bff"></i>
                                                    </h5>
                                                    <h3 class="card-text">{{__('index.bussines')}}</h3>
                                                    <a href="{{ route('empresa.index') }}" class="stretched-link"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @break

                                    @case('Pasarela')
                                        <div class="col-sm-3 form-group">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class="fas fa-money-check-alt fa-6x" style="color:#007bff"></i>
                                                    </h5>
                                                    <h3 class="card-text">{{__('index.payment')}}</h3>
                                                    <a href="{{ route('payments.index') }}" class="stretched-link"></a>
                                                </div>
                                            </div>
                                        </div>
                                    @break
                                @endswitch
                            @endforeach
                            <div class="col-sm-43 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-key fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{__('index.login')}}</h3>
                                        <a href="{{ route('configuracion.auth.login') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-cloud-download-alt fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{__('index.export.import')}}</h3>
                                        <a href="{{ route('import.files') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-sitemap fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{__('index.modules')}}</h3>
                                        <a href="{{ route('modulos.index') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-coins fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{__('index.backup')}}</h3>
                                        <a href="{{ route('configuracion.copias') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-edit fa-6x" style="color:#007bff"></i>
                                        </h5>
                                        <h3 class="card-text">{{__('index.layout')}}</h3>
                                        <a href="{{ route('plantillas') }}" class="stretched-link"></a>
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
