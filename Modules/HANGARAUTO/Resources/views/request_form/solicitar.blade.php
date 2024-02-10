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
                        {!! Form::open(['url' => route('cefa.parking.guardar'), 'id' => 'vehicle-request-form']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('search', trans('Nombre')) !!}
                                    {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => trans('Nombre'), 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('start_date', trans('Fecha Del Viaje')) !!}
                                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('end_date', trans('Fecha De Regreso')) !!}
                                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('department', trans('Departamento Donde Se Dirige')) !!}
                                    {!! Form::select('department', $department, null, ['class' => 'form-control', 'placeholder' => trans('Seleccione El Departamento'), 'id' => 'department']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('department', trans('Cuidad Donde Se Dirige')) !!}
                                    {!! Form::select('department', $department, null, ['class' => 'form-control', 'placeholder' => trans('Selecciona La Cuidad'), 'id' => 'department']) !!}
                                </div>
                                <div class="form-group">
                                    <div id="divMunicipality">
                                        <!-- Municipality field will be populated by AJAX -->
                                    </div>
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

@section('scripts')
<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
        // Obtén el botón de guardar por su ID
        var btn_guardar = document.getElementById('btn_guardar');

        // Agrega un evento de clic al botón de guardar
        btn_guardar.addEventListener('click', function (event) {
            // Previene el comportamiento predeterminado del botón de enviar (por ejemplo, enviar el formulario)
            event.preventDefault();

            // Redirige a la vista de resultados
            window.location.href = 'cefa.parking.table';
        });
    });
</script>
@stop