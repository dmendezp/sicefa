@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::solicitar.Tilte_Card_Records_Saver') }} / {{ trans('hangarauto::solicitar.Request_Vehicle') }}</li>
@endpush

@section('content')
    <section class="content-header">
        <div class="content">
            <div class="row justify-content-center">
                <div class="card card-primary card-outline shadow col-md-8">
                    <div class="card-header">
                        <h3>{{ trans('hangarauto::solicitar.Request_Vehicle') }}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => route('cefa.parking.guardar')]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name', trans('Nombre')) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('Nombre'), 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('start_date', trans('Fecha Del Viaje')) !!}
                                    {{ Form::input('dateTime-local', 'start_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('end_date', trans('Fecha De Regreso')) !!}
                                    {{ Form::input('dateTime-local', 'end_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('department', trans('Departamento Donde Se Dirige')) !!}
                                    {!! Form::select('department', $department, null, ['class' => 'form-control', 'placeholder' => trans('Seleccione El Departamento'), 'id' => 'department']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('municipality', trans('Cuidad Donde Se Dirige')) !!}
                                    <select name="municipality" id="municipality" class="form-control" disabled>
                                        <option value="">{{ trans('Seleccione La Ciudad') }}</option>
                                    </select>
                                </div>        
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('vehicle', trans('Vehiculo')) !!}
                                    {!! Form::select('vehicle', $vehicles, null, ['class' => 'form-control', 'placeholder' => trans('Seleccione El Vehiculo'), 'id' => 'vehicle']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('driver', trans('Conductor')) !!}
                                    <select name="driver" id="driver" class="form-control" disabled>
                                        <option value="">{{ trans('Seleccione el Conductor') }}</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    {!! Form::label('numstudents', trans('Numero De Pasajeros')) !!}
                                    {!! Form::number('numstudents', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('reason', trans('Motivo De Viaje')) !!}
                                    {!! Form::textarea('reason', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <center>{!! Form::submit(trans('ENVIAR'), ['class' => 'btn btn-success', 'id' => 'btn_guardar']) !!}</center>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departmentId = $(this).val();

            // Realizar la petición AJAX
            $.ajax({
                url: '/hangarauto/get-municipalities/' + departmentId,
                type: 'GET',
                success: function(response) {
                    // Limpiar el select de municipios
                    $('#municipality').empty();

                    // Habilitar el select de municipios
                    $('#municipality').prop('disabled', false);

                    // Agregar las opciones de municipios al select
                    $.each(response, function(key, value) {
                        $('#municipality').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        $('#vehicle').change(function() {
            var vehicleId = $(this).val();

            // Realizar la petición AJAX
            $.ajax({
                url: '/hangarauto/get-drivers/' + vehicleId,
                type: 'GET',
                success: function(response) {
                    // Limpiar el select de municipios
                    $('#driver').empty();

                    // Habilitar el select de municipios
                    $('#driver').prop('disabled', false);

                    // Agregar las opciones de municipios al select
                    $.each(response, function(key, value) {
                        $('#driver').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

</script>

