@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{__('layout.custom.title')}}</h2>
            <h5 class="text-white op-7 mb-2">{{__('layout.custom.subtitle')}}</h5>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/base/js/user.js') }}"></script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <h1>{{__('layout.custom.styles.title')}}</h1>
                        <div class="dropdown-divider"></div>
                        {!! Form::open(['route' => 'plantillas.store']) !!}
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>{{__('layout.custom.color.navbar')}}</label>
                                {!! Form::select(
                                    'color_logo',
                                    [
                                        'dark' => '⚫ Negro',
                                        'blue' => '🔵 Azul claro',
                                        'purple' => '🟣 Purpura',
                                        'blue2' => '🔵 Azul oscuro',
                                        'green' => '🟢 Verde',
                                        'orange' => '🟡 Naranja',
                                        'red' => '🔴 Rojo',
                                    ],
                                    $plantilla->color_logo,
                                    ['class' => 'form-control', 'id' => 'colorHeader'],
                                ) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{__('layout.custom.color.header')}}</label>
                                {!! Form::select(
                                    'color_header',
                                    [
                                        'dark' => '⚫ Negro',
                                        'blue' => '🔵 Azul claro',
                                        'purple' => '🟣 Purpura',
                                        'blue2' => '🔵 Azul oscuro',
                                        'green' => '🟢 Verde',
                                        'orange' => '🟡 Naranja',
                                        'red' => '🔴 Rojo',
                                    ],
                                    $plantilla->color_header,
                                    ['class' => 'form-control', 'id' => 'colorNavbarHeader'],
                                ) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{__('layout.custom.color.sidebar')}}</label>
                                {!! Form::select('color_sidebar', ['white' => '⚪ Banco', 'dark' => '⚫ Negro'], $plantilla->color_sidebar, [
                                    'class' => 'form-control',
                                    'id' => 'colorSidebar',
                                ]) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>{{__('layout.custom.color.background')}}</label>
                                {!! Form::select('color_body', ['white' => '⚪ Banco', 'dark' => '⚫ Negro'], $plantilla->color_body, [
                                    'class' => 'form-control',
                                    'id' => 'colorBody',
                                ]) !!}
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ url('configuracion') }}" class="btn btn-danger">Ir a Configuracion</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
