@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::solicitar.Request_Vehicle') }}</li>
@endpush
@section('content')
    {!! Html::script('js/jquery-2.1.0.min.js') !!}
    {!! Html::script('js/dropdown.js') !!}
    <section class="content-header">
        <div class="content">
            <div class="row justify-content-center">
                <div class="card card-primary card-outline shadow col-md-4">
                    <div class="card-header">
                        <h3>Solicitar Vehiculo</h3>
                    </div>
                    <br>
                    <div class="form_search" id="form_search">
                        {!! Form::open(['url' => route('cefa.parking.solicitar.search')]) !!}
                        <div class="row">
                            <div class="col-md-8">
                                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese N° De Documento', 'required']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::submit('Buscar', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {!! Form::open(['url' => route('cefa.parking.guardar')]) !!}
                    @if(@isset($people))
                        @if(is_null($people))
                            <h1>"Documento No Encontrado"</h1>
                            @else
                                <label class="mtop16" for="name">Nombre:</label>
                                <div>
                                    {{ $people->first_name." ".$people->first_name." ".$people->second_last_name }}
                                    {!! Form::hidden('person_id', $people->id) !!}
                                </div>
                        @endif
                    @endif
                    <label for="name">Fecha De Inicio:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                                {{ Form::input('dataTime-local', 'start_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control']) }}
                            </span>
                        </div>
                    </div>

                    <label for="name">Fecha De Fin:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                                {{ Form::input('dateTime-local', 'end_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control']) }}
                            </span>
                        </div>
                    </div>

                    <label for="name">Departamento Donde Se Dirije:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-select"></i>
                            </span>
                        </div>
                        {!! Form::select('department',$department, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --', 'id' => 'department']) !!}
                    </div>
                    <div id="divMunicipality">
                        <label for="name">Ciudad Donde Se Dirige:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                            </div>
                            {!! Form::select('municipality',[], null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --', 'id' => 'municipality']) !!}
                        </div>
                    </div>
                    <label for="name">N° De Pasajeros:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                        </div>
                        {!! Form::number('numstudents', null, ['class' => 'form-control']) !!}
                    </div>
                    <label for="name">Motivo Del Viaje:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                        </div>
                        {!! Form::textarea('reason', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="mt-4 text-center mb-4">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#department").change(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "{{route('cefa.parking.solicitar.municipios.search')}}",
                    data: {department_id: $(this).val()}
                })
                .done(function(html){
                    $("#divMunicipality").html(html);
                });
            });
        });
    </script>
@stop