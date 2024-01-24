@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::Vehicles.Vehicles') }}</li>
@endpush

@section('content')
    <br>
    <div class="content">
        <div class="row justify-content-center">
            <div class="card card-primary card-outline shadow col-md-4">
                <div class="card-header">
                    <h3>Modificar Datos Del Vehiculo</h3>
                </div>
                {{ csrf_field() }}
                {!! Form::open(['url' => '/hangarauto/administrator/vehicles/edit/'.$vehicle->id]) !!}
                <label for="name">Vehiculo:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                    </div>
                    {!! Form::text('name', (( $vehicle->name )), ['class' => 'form-control']) !!}
                </div>
                <label for="name">Referencia:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                    </div>
                    {!! Form::select('referece', getEnumValues("vehicles", "referece"), null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <label for="name">Estado Del Vehiculo:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                    </div>
                    {!! Form::select('status',getEnumValues("vehicles", "status"), null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <label for="name">Nivel De Combustible:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                    </div>
                    {!! Form::select('fuel_level',getEnumValues("vehicles", "fuel_level"), null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                </div>
                <label for="name">Placa:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                    </div>
                    {!! Form::text('license',(( $vehicle->license)), null, ['class' => 'form-control']) !!}
                </div>
                <div class="mt-4 text-center mb-4">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop