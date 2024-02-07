@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Configuracion de Forix</h2>
            <h5 class="text-white op-7 mb-2">Software CRM</h5>
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
                                        <h3 class="card-text">USUARIOS</h3>
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
                                                    <h3 class="card-text">PROVEEDORES</h3>
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
                                                    <h3 class="card-text">EMPRESA</h3>
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
                                                    <h3 class="card-text">PASARELAS DE PAGO</h3>
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
                                        <h3 class="card-text">INICIO DE SESION</h3>
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
                                        <h3 class="card-text">EXPORTAR - IMPORTAR DATOS</h3>
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
                                        <h3 class="card-text">CONFIGURAR MODULOS</h3>
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
                                        <h3 class="card-text">COPIAS DE SEGURIDAD</h3>
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
                                        <h3 class="card-text">EDITAR PLANTILLAS</h3>
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
