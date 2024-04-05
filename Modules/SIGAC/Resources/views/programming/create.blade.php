@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'sigac.academic_coordination.programming.store', 'method' => 'POST']) !!}
            @csrf
            <div class="form-group">
                {!! Form::label('instructor', 'Instructor') !!}
                <div class="input-select">
                    {!! Form::select('person_id', $instructors->pluck('first_name', 'id'), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el instructor', 'required']) !!}
                </div>
                @error('instructor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('environment', 'Ambiente') !!}
                <div class="input-select">
                    {!! Form::select('environment_id', $environments->pluck('name', 'id'), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el ambiente', 'required']) !!}
                </div>
                @error('environment')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('course', 'Curso') !!}
                <div class="input-select">
                    {!! Form::select('course_id', $courses->pluck('program.name', 'id')->map(function ($item, $key) use ($courses) {
                        return $item . ' - ' . $courses->find($key)->code;
                    }), null, ['class' => 'form-select', 'placeholder' => 'Seleccione el curso','id'=> 'course']) !!}
                </div>
                @error('course')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('date', 'Fecha') !!}
                {!! Form::date('date', null, ['class' => 'form-control', 'aria-label' => 'fecha', 'aria-describedby' => 'basic-addon1', 'required']) !!}
                @error('date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('start_time', 'Hora de entrada') !!}
                {!! Form::time('start_time', null, ['class' => 'form-control', 'aria-label' => 'fecha', 'aria-describedby' => 'basic-addon1', 'required']) !!}
                @error('start_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('end_time', 'Hora de salida') !!}
                {!! Form::time('end_time', null, ['class' => 'form-control', 'aria-label' => 'fecha', 'aria-describedby' => 'basic-addon1', 'required']) !!}
                @error('end_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#course').select2(); // Inicializa el campo course como select2
    });
</script>
    
@endpush
