@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Consumo</li>
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
                    <h3>Modificar Datos del Consumo</h3>
                </div>
                {!! Form::model($consumo, ['route' => ['hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.consumo.update', $consumo->id], 'method' => 'PUT']) !!}
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="vehicle_id" class="form-label">{{trans('hangarauto::Vehiculos.Vehicle') }}:</label>
                        {!! Form::select('vehicle_id', $vehicles,  $consumo->vehicle->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="person_id" class="form-label">{{trans('hangarauto::Vehiculos.Responsability') }}:</label>
                        {!! Form::select('person_id', $drivers, $consumo->person->fullnmae, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">{{trans('hangarauto::Vehiculos.Date') }}:</label>
                        {!! Form::date('date', $consumo->date, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="fuel_type" class="form-label">Tipo de Combustible:</label>
                        {!! Form::select('fuel_type_id', $fuel_type, $consumo->fuel_type->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="measurement_unit_id" class="form-label">{{trans('hangarauto::Vehiculos.Measurement Unit') }}:</label>
                        {!! Form::select('measurement_unit_id', $measurement_units, $consumo->measurement_unit->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">{{trans('hangarauto::Vehiculos.Amount') }}:</label>
                        {!! Form::number('amount', $consumo->amount, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{trans('hangarauto::Vehiculos.Price') }}:</label>
                        {!! Form::number('price', $consumo->price, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="mileage" class="form-label">{{trans('hangarauto::Vehiculos.Mileage') }}:</label>
                        {!! Form::number('mileage', $consumo->mileage, ['class' => 'form-control']) !!}
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.tecnomecanica') }}" type="button">{{ trans('hangarauto::Drivers.Cancel') }}</a>
                        {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
