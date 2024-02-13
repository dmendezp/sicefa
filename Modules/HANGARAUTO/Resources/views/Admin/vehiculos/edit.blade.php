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
                {!! Form::model($vehicle, ['route' => ['hangarauto.admin.vehicles.update', $vehicle->id], 'method' => 'PUT']) !!}
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        {!! Form::text('name', $vehicle->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="reference" class="form-label">Referencia:</label>
                        {!! Form::select('reference', 
                            [
                                'Carro' => 'Carro',
                                'Camioneta' => 'Camioneta',
                                'Autobus' => 'Autobus',
                                'Tractor' => 'Tractor',
                                'Motocicleta' => 'Motocicleta',
                                'Furgoneta' => 'Furgoneta',
                                'Ciclomotor' => 'Ciclomotor',
                                'Motocarro' => 'Motocarro',
                            ], 
                            $vehicle->reference, 
                            ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) 
                        !!}
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado:</label>
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
                        <label for="license" class="form-label">Placa:</label>
                        {!! Form::text('license', $vehicle->license, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        <label for="fuel_level" class="form-label">Nivel de Gasolina:</label>
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
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
