@extends('hangarauto::layout.adminhome')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::') }}</li>
@endpush

@section('content')
<br>
<div class="content">
    <div class="row justify-content-center">
        <div class="card card-primary card-outline shadow col-md-4">
            <div class="card-header">
                <h3>Formato De Aceptacion De Solicitud</h3>
            </div>
            <form action="{{ route('admin.solicitudes.aceptado') }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Correo Del Solicitante:</label>
                        {!! Form::email('misena_email', $requests->people[0]->misena_email, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">Asignar Conductor:</label><br>
                        {!! Form::select('person_id', $drivers, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">Asignar Vehiculo:</label><br>
                        {!! Form::select('vehicle_id', $vehicles, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">Mensaje:</label>
                        {!! Form::text('msg', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-contact" class="btn">Enviar</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@stop