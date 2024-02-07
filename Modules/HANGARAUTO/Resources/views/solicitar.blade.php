@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::solicitar.Request_Vehicle') }}</li>
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
                        {!! Form::open(['url' => route('cefa.parking.guardar'), 'id' => 'vehicle-request-form']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('search', trans('Nombre')) !!}
                                    {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => trans('Nombre'), 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('start_date', trans('FechaInicio')) !!}
                                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('end_date', trans('Fecha fin')) !!}
                                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('department', trans('Departamento Donde Se Dirige')) !!}
                                    {!! Form::select('department', $department, null, ['class' => 'form-control', 'placeholder' => trans('Seleccione El Departamento'), 'id' => 'department']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div id="divMunicipality">
                                        <!-- Municipality field will be populated by AJAX -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('department', trans('Cuidad Donde Se Dirige')) !!}
                                    {!! Form::select('department', $department, null, ['class' => 'form-control', 'placeholder' => trans('Selecciona La Cuidad'), 'id' => 'department']) !!}
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
                            {!! Form::submit(trans('ENVIAR'), ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("#department").change(function() {
                $.ajax({
                    method: "POST",
                    url: "{{ route('cefa.parking.solicitar.municipios.search') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {department_id: $(this).val()},
                    success: function(html) {
                        $("#divMunicipality").html(html);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#vehicle-request-form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    method: "POST",
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response) {
                        // Handle success response
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error response
                    }
                });
            });
        });
    </script>
@stop