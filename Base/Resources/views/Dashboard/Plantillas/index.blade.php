@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">Modulo Plantillas</h2>
            <h5 class="text-white op-7 mb-2">En este Modulo puede Cambiar Estilos, Editar Estilos</h5>
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
                        <h1>Estilos del sistema</h1>
                        <div class="dropdown-divider"></div>
                        {!! Form::open(['route' => 'plantillas.store']) !!}
                        <div class="row">
                            @foreach ($plantilla as $item)
                                <div class="col-sm-6 form-group">
                                    <label>COLOR LOGO ENCABEZADO</label>
                                    <select name="color_logo" class="form-control" id="colorHeader">
                                        <option value="" selected disabled>seleccione un color</option>
                                        <option value="dark" @if ($item->color_logo == 'dark') selected @endif>⚫ Negro
                                        </option>
                                        <option value="blue" @if ($item->color_logo == 'blue') selected @endif>🔵 Azul
                                            oscuro</option>
                                        <option value="purple" @if ($item->color_logo == 'purple') selected @endif>🟣 Purpura
                                        </option>
                                        <option value="blue2" @if ($item->color_logo == 'blue2') selected @endif>🔵 Azul
                                            claro</option>
                                        <option value="green" @if ($item->color_logo == 'green') selected @endif>🟢 Verde
                                        </option>
                                        <option value="orange" @if ($item->color_logo == 'orange') selected @endif>🟡
                                            Naranja</option>
                                        <option value="red" @if ($item->color_logo == 'red') selected @endif>🔴 Rojo
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>COLOR ENCABEZADO DE LA BARRA DE NAVACIÓN</label>
                                    <select name="color_header" class="form-control" id="colorNavbarHeader">
                                        <option value="" selected disabled>seleccione un color</option>
                                        <option value="dark" @if ($item->color_header == 'dark') selected @endif>⚫ Negro
                                        </option>
                                        <option value="blue" @if ($item->color_header == 'blue') selected @endif>🔵 Azul
                                            oscuro</option>
                                        <option value="purple" @if ($item->color_header == 'purple') selected @endif>🟣 Purpura
                                        </option>
                                        <option value="blue2" @if ($item->color_header == 'blue2') selected @endif>🔵 Azul
                                            claro</option>
                                        <option value="green" @if ($item->color_header == 'green') selected @endif>🟢 Verde
                                        </option>
                                        <option value="orange" @if ($item->color_header == 'orange') selected @endif>🟡
                                            Naranja</option>
                                        <option value="red" @if ($item->color_header == 'red') selected @endif>🔴 Rojo
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>COLOR BARRA LATERAL</label>
                                    <select name="color_sidebar" class="form-control" id="colorSidebar">
                                        <option value="white" @if ($item->color_sidebar == 'white') selected @endif>⚪ Banco
                                        </option>
                                        <option value="dark" @if ($item->color_sidebar == 'dark') selected @endif>⚫ Negro
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>COLOR DE FONDO</label>
                                    <select name="color_body" class="form-control" id="colorBody">
                                        <option value="" selected disabled>seleccione un color</option>
                                        <option value="bg1" @if ($item->color_body == 'bg1') selected @endif>⚪ Banco
                                        </option>
                                        <option value="dark" @if ($item->color_body == 'dark') selected @endif>⚫ Negro
                                        </option>
                                    </select>
                                </div>
                            @endforeach
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
