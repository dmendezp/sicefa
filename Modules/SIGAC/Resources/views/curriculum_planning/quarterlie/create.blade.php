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
            {!! Form::open(['route' => 'sigac.academic_coordination.curriculum_planning.quarterlie.store', 'method' => 'POST']) !!}
                @csrf
                {!! Form::hidden('quarter_number', $quarter_number) !!}
                {!! Form::hidden('training_project_id', $training_project_id) !!}
                <label for="learning_outcome_id">{{ trans('Resultados de Aprendizaje') }}</label>
                <!-- Resultado de Aprendizaje -->
                <div id="learning_outcomes_container">
                    <!-- Campo de selección de resultado de aprendizaje -->
                    <div class="row align-items-center learning_outcomes_row">
                        <div class="col-10">
                            <div class="form-group">
                                
                                {!! Form::select(
                                    'learning_outcome_id[]',
                                    $learning_outcomes_select,
                                    [],
                                    ['class' => 'form-control select2', 'placeholder' => 'Seleccione el resultado de aprendizaje', 'id' =>'learning_outcome' ,'required']
                                ) !!}
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary add_learning_outcomes"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2(); // Inicializa el campo resultado de aprendizaje como select2

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

        // Manejador de eventos para el cambio en el campo "Actividad"
        $('.select2').on('change', function() {
            var learning_outcome_id = $(this).val(); // Obtener el ID de la actividad seleccionada

            // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
            $.ajax({
                url: '{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.filterlearnin_outcome') }}',
                method: 'GET',
                data: {
                    learning_outcome_id: learning_outcome_id
                },
                success: function(response) {
                    if (response == false) {
                        // El resultado de aprendizaje ya está asignado
                        learningOutcomeAssigned = true;
                        $('#learning_outcome_assigned_alert').show(); // Mostrar la alerta
                        $('#update_button').prop('disabled', true); // Desactivar el botón de actualizar
                    } else {
                        // El resultado de aprendizaje no está asignado
                        learningOutcomeAssigned = false;
                        $('#learning_outcome_assigned_alert').hide(); // Ocultar la alerta
                        $('#update_button').prop('disabled', false); // Habilitar el botón de actualizar
                    }
                },
                error: function() {
                    console.error('Error en la solicitud AJAX');
                }
            });
        });
    });
</script>
    
@endpush
