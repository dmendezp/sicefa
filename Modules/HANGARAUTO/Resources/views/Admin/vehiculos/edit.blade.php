@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::Vehiculos.Vehicles') }}</li>
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
                    <h3>Modificar Datos Del Vehiculo</h3>
                </div>
                {!! Form::model($vehicle, ['route' => ['hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.vehicles.update', $vehicle->id], 'method' => 'PUT']) !!}
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ trans('hangarauto::Drivers.Name') }}:</label>
                        {!! Form::text('name', $vehicle->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="vehicletype" class="form-label">Tipo de vehículo:</label>
                        {!! Form::select('vehicletype', $vehicletype, $vehicle->vehicle_type->name ?? null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">{{ trans('hangarauto::Vehiculos.Statu') }}:</label>
                        {!! Form::select('status', 
                            [
                                'Disponible' => 'Disponible',
                                'No Disponible' => 'No Disponible',
                            ], 
                            $vehicle->status, 
                            ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) 
                        !!}
                    </div>
                    <div class="mb-3">
                        <label for="license" class="form-label">{{ trans('hangarauto::Vehiculos.Plate') }}:</label>
                        {!! Form::text('license', $vehicle->license, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="fuel_level" class="form-label">{{ trans('hangarauto::Vehiculos.Fuel Level') }}:</label>
                        {!! Form::select('fuel_level', 
                            [
                                'Bajo' => 'Bajo',
                                'Medio' => 'Medio',
                                'Alto' => 'Alto',
                            ], 
                            $vehicle->fuel_level, 
                            ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) 
                        !!}
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.vehicles') }}" type="button">{{ trans('hangarauto::Drivers.Cancel') }}</a>
                        {!! Form::submit(trans('hangarauto::Drivers.Save'), ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
