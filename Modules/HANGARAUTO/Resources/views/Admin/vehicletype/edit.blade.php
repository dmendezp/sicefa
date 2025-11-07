@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Tipo de Combustible</li>
@endpush

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <br>
    <div class="content">
        <div class="row justify-content-center">
            <div class="card card-primary card-outline shadow col-md-4">
                <div class="card-header">
                    <h3>Modificar Datos del Tipo de Vehiculo</h3>
                </div>
                {!! Form::model($vehicletype, ['route' => ['hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.vehicletype.update', $vehicletype->id], 'method' => 'PUT']) !!}
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ trans('hangarauto::Drivers.Name') }}:</label>
                        {!! Form::text('name', $vehicletype->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.vehicletype') }}" type="button">{{ trans('hangarauto::Drivers.Cancel') }}</a>
                        {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
