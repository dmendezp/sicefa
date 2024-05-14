@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.programming.management.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('querter_number', 'Trimestre') !!}
                    <div class="input-select">
                        {!! Form::select('querter_number', ['' => trans('Seleccione el trimestre'), '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7'], null, ['class' => 'form-control', 'required' , 'id' => 'quarter_number']) !!}
                    </div>
                    @error('course')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('course', 'Curso') !!}
                </div>
                
            </div>
        </div>
        <div id="quaterlie">
            <div class="card">
                <div class="card-header">
                    <h2>Trimestralización</h2>
                </div>
                <div class="card-body">
                    <div id="cometencies"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h2>Programación</h2>
            </div>
            <div class="card-body">
                @if(session('mensaje'))
                    <p>
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="form-group">
                    {!! Form::label('learning_outcome', 'Resultado de Aprendizaje') !!}
                    <div class="input-select">
                        {!! Form::select('learning_outcome', [], old('learning_outcome'), ['class' => 'form-control select2 learning_outcome_select', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('instructor', 'Instructor') !!}
                    <div class="input-select">
                        {!! Form::select('instructor', [], old('instructor'), ['class' => 'form-control select2 instructors', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('environment', 'Ambiente') !!}
                    <div class="input-select">
                        {!! Form::select('environment', [], old('environment'), ['class' => 'form-control select2 environments', 'required']) !!}
                    </div>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <b>Seleccion de fechas</b>
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
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
                            <br>
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
                        </div>
                      </div>
                    </div>
                  </div>
                <br>
                {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    
@endsection
