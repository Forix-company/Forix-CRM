@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{ __('import.export.title') }}</h2>
            <h5 class="text-white op-7 mb-2">{{ __('import.export.subtitle') }}</h5>
        </div>
    </div>
@endsection
@section('content')
    <div class="dropdown-divider"></div>
    <h1 style="text-align: center">{{ __('export.title.card') }}</h1>
    <div class="dropdown-divider"></div>
    <div class="page-inner">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('export.category.title') }}</div>
                        <div class="card-category">{{ __('export.excel.title') }}</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.category') }}"
                                    class="btn btn-primary">{{ __('export.button') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('export.label.title') }}</div>
                        <div class="card-category">{{ __('export.excel.title') }}</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.etiqueta') }}"
                                    class="btn btn-primary">{{ __('export.button') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('export.manufactory.title') }}</div>
                        <div class="card-category">{{ __('export.excel.title') }}</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.factory') }}"
                                    class="btn btn-primary">{{ __('export.button') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('export.supplier.title') }}</div>
                        <div class="card-category">{{ __('export.excel.title') }}</div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <a href="{{ route('export.supplier') }}"
                                    class="btn btn-primary">{{ __('export.button') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <h1 style="text-align: center">{{ __('import.title.card') }}</h1>
    <div class="dropdown-divider"></div>
    <div class="page-inner">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('import.category.title') }}</div>
                        <div class="card-category">{{ __('import.excel.title') }}</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.category', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>{{ __('import.excel.subtitle') }}</label>
                                {!! Form::file('category', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit(__('import.button'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('import.label.title') }}</div>
                        <div class="card-category">{{ __('import.excel.title') }}</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.etiqueta', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>{{ __('import.excel.subtitle') }}</label>
                                {!! Form::file('etiqueta', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit(__('import.button'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('import.manufactory.title') }}</div>
                        <div class="card-category">{{ __('import.excel.title') }}</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.factory', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>{{ __('import.excel.subtitle') }}</label>
                                {!! Form::file('factory', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit(__('import.button'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <div class="card-title">{{ __('import.supplier.title') }}</div>
                        <div class="card-category">{{ __('import.excel.title') }}</div>
                        {!! Form::model(null, [
                            'method' => 'POST',
                            'route' => ['import.supplier', auth()->user()->id],
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>{{ __('import.excel.subtitle') }}</label>
                                {!! Form::file('proveedor', ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::submit(__('import.button'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
