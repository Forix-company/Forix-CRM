@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{__('modules.admin.title')}}</h2>
            <h5 class="text-white op-7 mb-2">{{__('modules.admin.subtitle')}}</h5>
        </div>
    </div>
@endsection
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        {!! Form::open(['route' => 'modulos.store']) !!}
                        @php $counter = 0; @endphp
                        <div class="row">
                            @foreach ($allModules as $module)
                                @if ($module->isEnabled() == 1)
                                    <div class="col-md-3">
                                        <div class="form-group shadow-lg p-3 mb-4">
                                            <input type="checkbox" name="modules[]" value="{{ $module->getName() }}"
                                                checked>
                                            <label>{{ $module->getName() }}</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" name="modules[]" value="{{ $module->getName() }}">
                                            <label>{{ $module->getName() }}</label>
                                        </div>
                                    </div>
                                @endif
                                @php $counter++; @endphp
                                @if ($counter % 4 === 0)
                        </div>
                        <div class="row">
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-12 form-group">
                            {!! Form::submit(__('button.create'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ url('configuracion') }}" class="btn btn-danger">{{__('button.back')}}</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
