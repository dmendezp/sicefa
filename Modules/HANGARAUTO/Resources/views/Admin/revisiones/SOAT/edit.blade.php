@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Soat</li>
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
                    <h3>Modificar Datos del Soat</h3>
                </div>
                {!! Form::model($soat, ['route' => ['hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.soat.update', $soat->id], 'method' => 'PUT']) !!}
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="vehicle_id" class="form-label">{{trans('hangarauto::Vehiculos.Vehicle') }}:</label>
                        {!! Form::select('vehicle_id', $vehicles, $soat->vehicle->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="person_id" class="form-label">{{trans('hangarauto::Vehiculos.Responsability') }}:</label>
                        {!! Form::select('person_id', $drivers, $soat->person->fullname, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="review_date" class="form-label">{{trans('hangarauto::Vehiculos.Review Date') }}:</label>
                        {!! Form::date('review_date', $soat->review_date, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="expiration_date" class="form-label">{{trans('hangarauto::Vehiculos.Expiration Date') }}:</label>
                        {!! Form::date('expiration_date', $soat->expiration_date, ['class' => 'form-control']) !!}
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.soat') }}" type="button">{{ trans('hangarauto::Drivers.Cancel') }}</a>
                        {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
