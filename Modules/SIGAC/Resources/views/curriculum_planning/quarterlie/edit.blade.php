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
            <!-- Alerta para mostrar si el resultado de aprendizaje ya está asignado -->
            <div class="alert alert-danger" id="learning_outcome_assigned_alert" style="display: none;">
                El resultado de aprendizaje ya está asignado.
            </div>

            {!! Form::model($quarterlie, ['route' => ['sigac.academic_coordination.curriculum_planning.quarterlie.update', $quarterlie->id], 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    <label for="training_project_id">{{ trans('Proyecto Formativo') }}</label>
                    {!! Form::select(
                        'training_project_id',
                        $training_projects,
                        $quarterlie->training_project_id,
                        ['class' => 'form-control', 'placeholder' => 'Seleccione el proyecto formativo', 'id' =>'training_project', 'required']
                    ) !!}
                </div>
                <label for="learning_outcome_id">{{ trans('Resultados de Aprendizaje') }}</label>
                @foreach($allQuarterlies as $index => $allQuarterli)
                <!-- Resultado de Aprendizaje -->
                <div id="learning_outcomes_container_{{ $index }}">
                        <!-- Campo de selección de resultado de aprendizaje -->
                    <div class="row align-items-center learning_outcomes_row">
                        <div class="col-10">
                            <div class="form-group">
                                {!! Form::select(
                                    'learning_outcome_id[]',
                                    $learning_outcomes_select,
                                    $allQuarterli->learning_outcome_id,
                                    ['class' => 'form-control select2 learning_outcome_select', 'placeholder' => 'Seleccione el resultado de aprendizaje', 'id' =>'learning_outcome_' . $index, 'required']
                                ) !!}
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger delete-row" data-learning-outcome="{{ $allQuarterli->learning_outcome_id }}"><i class="fas fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                {!! Form::hidden('deleted_learning_outcomes[]', null, ['class' => 'deleted-learning-outcomes']) !!} <!-- Campo de lista oculto para almacenar los IDs de los resultados de aprendizaje eliminados -->
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Update'), ['class' => 'btn btn-primary', 'id' => 'standcolor', 'id' => 'update_button']) !!} <!-- Añadir un ID al botón de actualizar -->
            {!! Form::close() !!}
        </div>
    </div>
@endsection


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Inicializa Select2 para todos los selectores con clase select2
        $('.select2').select2();

        // Variable para indicar si el resultado de aprendizaje ya está asignado
        var learningOutcomeAssigned = false;

        // Función para eliminar fila de resultado de aprendizaje
        $(document).on('click', '.delete-row', function() {
            var deletedLearningOutcomeId = $(this).data('learning-outcome');
            $(this).closest('.learning_outcomes_row').remove();
            $('.deleted-learning-outcomes').val(function(_, val) {
                return (val ? val + ',' : '') + deletedLearningOutcomeId; // Agrega el ID del resultado de aprendizaje eliminado a la lista oculta
            });
        });

        // Manejador de eventos para el cambio en el campo "Actividad"
        $('.select2').on('change', function() {
            var learning_outcome_id = $(this).val(); // Obtener el ID de la actividad seleccionada

            // Verificar si hay valores duplicados en el select
            var values = $('.learning_outcome_select').map(function() {
                return $(this).val();
            }).get();
            var uniqueValues = values.filter(function(item, index, self) {
                return self.indexOf(item) === index;
            });
            duplicateValues = values.length !== uniqueValues.length;

            // Mostrar alerta si hay valores duplicados
            if (duplicateValues) {
                $('#learning_outcome_assigned_alert').show();
                $('#update_button').prop('disabled', true);
                return;
            } else {
                $('#learning_outcome_assigned_alert').hide();
                $('#update_button').prop('disabled', false);
            }

        });
    });
</script>
