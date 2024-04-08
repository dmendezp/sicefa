@extends('sigac::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('Proyecto Formativo y Trimestralización') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'sigac.academic_coordination.curriculum_planning.training_project.store', 'method' => 'POST']) !!}
            @csrf
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Ingrese el nombre', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('execution_time', 'Tiempo de ejecucion') !!}
                {!! Form::number('execution_time', null, ['class' => 'form-control','placeholder' => 'Ingrese el número de meses de ejecucion', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('total_result', 'Número Total resultados de aprendizaje') !!}
                {!! Form::number('total_result', null, ['class' => 'form-control','placeholder' => 'Ingrese el total de resultados de aprendizaje', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('objective', trans('Objetivo')) !!}
                {!! Form::textarea('objective', old('objective'), [
                    'class' => 'form-control',
                    'style' => 'max-height: 100px;',
                ]) !!}
            </div>
            <br>
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#course').select2(); // Inicializa el campo course como select2

        $('#learning_outcome').select2(); // Inicializa el campo resultado de aprendizaje como select2

        // Función para agregar fila de resultado de aprendizaje
        $(".add_learning_outcomes").click(function() {
            var clonedRow = $(".learning_outcomes_row").first().clone();
            clonedRow.find('select').val(''); // Limpiar el valor seleccionado
            $("#learning_outcomes_container").append(clonedRow);
        });

        // Función para eliminar fila de resultado de aprendizaje
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.learning_outcomes_row').remove();
        });
    });
</script>
    
@endpush
