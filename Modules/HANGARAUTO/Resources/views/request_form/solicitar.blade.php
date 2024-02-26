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
                        @if (Route::is('hangarauto.admin.*'))
                        {!! Form::open(['url' => route('hangarauto.admin.petitions.add')]) !!}
                        @elseif (Route::is('hangarauto.charge.*'))
                        {!! Form::open(['url' => route('hangarauto.charge.petitions.add')]) !!}
                        @else 
                        {!! Form::open(['url' => route('cefa.parking.guardar')]) !!}
                        @endif
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicletype" class="form-label">Tipo de vehiculo :</label>
                                    {!! Form::select('vehicletype', $vehicletype, null, ['class' => 'form-control', 'placeholder' => trans('Seleccione El Vehiculo'), 'id' => 'vehicletype']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('start_date', trans('Fecha Del Viaje')) !!}
                                    {{ Form::input('dateTime-local', 'start_date', null, ['id' => 'start_date', 'class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('end_date', trans('Fecha De Regreso')) !!}
                                    {{ Form::input('dateTime-local', 'end_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control start_date']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('department', trans('Departamento Donde Se Dirige')) !!}
                                    {!! Form::select('department', $department, null, ['class' => 'form-control', 'placeholder' => trans('Seleccione El Departamento'), 'id' => 'department']) !!}
                                </div>
                                       
                            </div>
                            <div class="col-md-6">  
                                <div class="form-group">
                                    {!! Form::label('municipality', trans('Cuidad Donde Se Dirige')) !!}
                                    <select name="municipality" id="municipality" class="form-control" disabled>
                                        <option value="">{{ trans('Seleccione La Ciudad') }}</option>
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
                    console.log(response);                    // Limpiar el select de municipios
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
                data: { start_date: $('#start_date').val() }, // Envía el valor del campo start_date
                success: function(response) {
                    // Limpiar el select de conductores
                    $('#driver').empty();

                    // Agregar la opción al principio
                    $('#driver').append('<option value="">' + 'Seleccione el conductor' + '</option>');

                    if (response.length > 0) {
                        // Habilitar el select de conductores
                        $('#driver').prop('disabled', false);

                        // Agregar las opciones de conductores al select
                        $.each(response, function(key, value) {
                            $('#driver').append('<option value="' + value.id + '">' + value.person.first_name + ' ' + value.person.first_last_name + '</option>');
                        });
                    } else {
                        // Deshabilitar el select de conductores
                        $('#driver').prop('disabled', true);

                        // Mostrar un mensaje indicando que el vehículo no está disponible para este día
                        $('#driver').append('<option value="">' + 'Vehículo no disponible para este día' + '</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#start_date').change(function() {
            var start_date = $(this).val();

            // Obtener la fecha actual
            var currentDate = new Date();
            // Sumar 5 días a la fecha actual
            currentDate.setDate(currentDate.getDate() + 5);

            // Convertir la fecha actual más 5 días a formato 'YYYY-MM-DD'
            var fiveDaysLater = currentDate.toISOString().slice(0, 10);

            // Verificar si la fecha seleccionada es al menos 5 días después de la fecha actual
            if (start_date < fiveDaysLater) {
                // Mostrar un mensaje indicando que la fecha seleccionada debe ser al menos 5 días después de la fecha actual
                alert('La fecha seleccionada debe ser al menos 5 días después de la fecha actual');
                // Limpiar el valor del campo de fecha
                $(this).val('');
                // Salir de la función
                return;
            }

            // Realizar la petición AJAX para obtener los vehículos disponibles
            $.ajax({
                url: '/hangarauto/get-vehiclessolicitar/' + start_date,
                type: 'GET',
                data: { vehicletype: $('#vehicletype').val() },
                success: function(response) {

                    if (response.length > 0) {
                        return true;
                    } else {
                        // Mostrar un mensaje indicando que la fecha seleccionada debe ser al menos 5 días después de la fecha actual
                        alert('No hay vehiculos disponibles de este tipo para la fecha seleccionada : ' + 
                        'Eliga otra fecha para la solicitud                                                         ' +
                        'Eliga otro tipo de vehiculo');
                        // Limpiar el valor del campo de fecha
                        $(this).val('');

                        // Limpiar el select de conductores
                        $('#start_date').empty();
                        // Salir de la función
                        return;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


    });

</script>

