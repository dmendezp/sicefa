@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-12">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sigac.academic_coordination.profession.dates_index.store_dates') }}" method="post">
                            @csrf
                            @if(session('mensaje'))
                                <p>
                                    {{ session('mensaje') }}
                                </p>
                            @endif
                            <div class="form-group">
                                {!! Form::label('course', trans('sigac::learning_out_come.Courses')) !!}
                                {!! Form::select('course', ['' => 'Seleccione un curso', '399' => 'ADSO', '1' => 'GESTION DE EMPRESAS AGROPECUARIAS'], old('course'), ['class' => 'form-control course'],) !!}                                    
                            </div>
                            <div class="form-group">
                                {!! Form::label('instructor', trans('sigac::learning_out_come.Instructor')) !!}
                                {!! Form::select('instructor', ['' => 'Seleccione un instructor', '142923' => 'JULIAN JAVIER RAMIREZ DIAZ', '1' => 'Ruben'], old('instructor'), ['class' => 'form-control instructor'],) !!}                                    
                            </div>
                            <div class="form-group">
                                {!! Form::label('environment', 'Ambiente') !!}
                                {!! Form::select('environment', ['' => 'Seleccione un ambiente', '1' => 'ADSO', '2' => 'ADSI'], old('ambiente'), ['class' => 'form-control ambiente'],) !!}                                    
                            </div>
                            <div class="form-group">
                                {!! Form::label('learning_outcome', 'Resultado de aprendizaje') !!}
                                {!! Form::select('learning_outcome', ['' => 'Seleccione un resultado de aprendizaje', '1' => 'Identificar la dinámica organizacional del SENA y  el rol de la Formación Profesional Integral de acuerdo con su proyecto de vida y el desarrollo profesional.', '2' => 'Caracterizar los procesos de la organización de acuerdo con el software a construir.', '3' => 'Recolectar información del software a construir de acuerdo con las necesidades del cliente.'], old('learning_outcome'), ['class' => 'form-control learning_outcome'],) !!}                                    
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Monday', null, false, ['class' => 'form-check-input', 'id' => 'monday']) !!}
                                {!! Form::label('lunes', 'Lunes', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Tuesday', null, false, ['class' => 'form-check-input', 'id' => 'tuesday']) !!}
                                {!! Form::label('martes', 'Martes', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Wednesday', null, false, ['class' => 'form-check-input', 'id' => 'wednesday']) !!}
                                {!! Form::label('miercoles', 'Miercoles', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Thursday', null, false, ['class' => 'form-check-input', 'id' => 'thursday']) !!}
                                {!! Form::label('jueves', 'Jueves', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Friday', null, false, ['class' => 'form-check-input', 'id' => 'friday']) !!}
                                {!! Form::label('viernes', 'Viernes', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Saturday', null, false, ['class' => 'form-check-input', 'id' => 'saturday']) !!}
                                {!! Form::label('sabado', 'Sábado', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::checkbox('days[]', 'Sunday', null, false, ['class' => 'form-check-input', 'id' => 'sunday']) !!}
                                {!! Form::label('domingo', 'Domingo', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    {!! Form::label('start_date', 'Fecha de inicio') !!}
                                    {!! Form::date('start_date', now(), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('end_date', 'Fecha de finalización') !!}
                                    {!! Form::date('end_date', now(), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('start_time', 'Hora de inicio') !!}
                                    {!! Form::time('start_time', now()->format('H:i'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('end_time', 'Hora de finalización') !!}
                                    {!! Form::time('end_time', now()->format('H:i'), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">{{ trans('sigac::profession.Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection