@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>{{ trans('hangarauto::Vehiculos.Search Vehicle') }}</h3>
            </div>
            <div class="form_search" id="form_search">
                <br>
                {!! Form::open(['route' => 'hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.vehicles.report.search']) !!}
                <div class="row">
                    <div class="col-md-8">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Numero de Placa', 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::submit(trans('hangarauto::Drivers.Search'), ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <br>
            </div>
        </div>
    </div>
</div>
@if(isset($vehicle))
    @if(is_null($vehicle))
        <div class="content">
            <div class="row justify-content-center">
                <div class="card card-primary card-outline shadow col-md-4" style="width: 900px">
                    <div class="card-header">
                        <h3>Vehiculo No Encontrado</h3>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="content">
        <div class="row justify-content-center">
            <div class="card card-primary card-outline shadow col-md-4" style="width: 900px">
                <div class="card-header">
                    <h3>Vehiculo</h3>
                </div>
                <div class="container">
                    <h4>Información del vehículo:</h4>
                    <p><strong>Nombre:</strong> {{ $vehicle->name }}</p>
                    <p><strong>Referencia:</strong> {{ $vehicle->reference }}</p>
                    <p><strong>Estado:</strong> {{ $vehicle->status }}</p>
                    <p><strong>Placa:</strong> {{ $vehicle->license }}</p>
                    <p><strong>Nivel de Gasolina:</strong> {{ $vehicle->fuel_level }}</p>
                    <!-- Aquí puedes mostrar más detalles del vehículo si es necesario -->
                </div>
                <div class="container mt-4">
                    <h4>Soats del vehículo:</h4>
                    <ul>
                        @foreach($vehicle->soats as $soat)
                            <li>
                                <p><strong>Fecha de revisión:</strong> {{ $soat->review_date }}</p>
                                <p><strong>Fecha de vencimiento:</strong> {{ $soat->expiration_date }}</p>
                                <!-- Aquí puedes mostrar más detalles del soat si es necesario -->
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="container mt-4">
                    <h4>Tecnomecánicas del vehículo:</h4>
                    <ul>
                        @foreach($vehicle->tecnomecanics as $tecnomecanic)
                            <li>
                                <p><strong>Fecha de revisión:</strong> {{ $tecnomecanic->review_date }}</p>
                                <p><strong>Fecha de vencimiento:</strong> {{ $tecnomecanic->expiration_date }}</p>
                                <!-- Aquí puedes mostrar más detalles de la tecnomecánica si es necesario -->
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="container mt-4">
                    <h4>Consumos del vehículo:</h4>
                    <ul>
                        @foreach($vehicle->fuel_consumptions as $consumo)
                            <li>
                                <p><strong>Fecha:</strong> {{ $consumo->date }}</p>
                                <p><strong>Responsable:</strong> {{ $consumo->person->fullname }}</p>
                                <p><strong>Cantidad:</strong> {{ $consumo->amount }}</p>
                                <p><strong>Precio:</strong> {{ $consumo->price }}</p>
                                <p><strong>Kilometraje:</strong> {{ $consumo->mileage }}</p>
                                <!-- Aquí puedes mostrar más detalles de la tecnomecánica si es necesario -->
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif
@endsection