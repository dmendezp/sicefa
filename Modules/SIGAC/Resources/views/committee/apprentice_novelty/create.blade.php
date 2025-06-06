@extends('sigac::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::programming.Breadcrumb_Active_Events') }}</li>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'sigac.instructor.committee.novelty.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('apprentice_id', trans('Aprendiz')) !!}
                    {!! Form::select('apprentice_id', [], null, [
                        'class' => 'form-control',
                        'id' => 'apprentice',
                        'placeholder' => 'Ingrese el nombre',
                        'required'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('missing_id', trans('Falta Cometida')) !!}
                    {!! Form::select('missing_id', $missings, null, [
                        'class' => 'form-control',
                        'id' => 'missing',
                        'placeholder' => 'Seleccione la falta',
                        'required'
                    ]) !!}
                </div>
                <div class="type_missing"></div>
                <div class="form-group">
                    {!! Form::label('type', 'Tipo de Novedad') !!}
                    {!! Form::select('type', ['Academica' => 'Academica', 'Disciplinaria' => 'Disciplinaria'], null, [
                        'class' => 'form-control',
                        'placeholder' => 'Seleccione el tipo de novedad',
                        'id' => 'type',
                        'height' => '50px',
                    ]) !!}
                </div>
                <div class="container_learning">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('competence','Competencia') !!}
                                {!! Form::select(
                                    'competences',
                                    $competences_select,
                                    [],
                                    ['class' => 'form-control competencies select2', 'placeholder' => 'Seleccione la competencia', 'id' => 'competencies']
                                ) !!}
                            </div>
                            <label for="learning_outcome_id">{{ trans('Resultados de Aprendizaje') }}</label>
                            
                            <!-- Resultado de Aprendizaje -->
                            <div id="learning_outcomes_container">
                                <!-- Campo de selección de resultado de aprendizaje -->
                                <div class="row align-items-center learning_outcomes_row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            {!! Form::select('learning_outcome_id[]', [], old('learning_outcome_id[]'), ['class' => 'form-control select2 learning_outcome_select']) !!}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary add_learning_outcomes"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>                 
                        </div>       
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('observation', trans('Observación')) !!}
                    {!! Form::textarea('observation', old('observation'), [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese la observación',
                        'style' => 'max-height: 100px;',
                    ]) !!}
                </div>
                {!! Form::submit(trans('Reportar Novedad'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.container_learning').hide();
        // Inicializar Select2 en campos de selección de personas

        $('.select2').select2({
        });
        
        $('#missing').select2();
        $('#apprentice').select2({
            placeholder: 'Consulte el Aprendiz',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.committee.searchapprentice') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    });
                    return {
                        results: results
                    };
                },
                cache: true
            }
        });
        
        $('#missing').on('change', function() {
            var missing = $(this).val(); // Obtener el ID de la falta seleccionada

            // Realizar una solicitud AJAX para enviar el ID seleccionado a la ruta o función de Laravel
            $.ajax({
                url: '{{ route('sigac.committee.searchmissing') }}', // Reemplaza con la ruta adecuada
                method: 'GET', // Puedes usar GET u otro método según tu configuración
                data: {
                    missing: missing
                }, // Enviar el ID seleccionado como parámetro
                success: function(response) {
                    $('.type_missing').html('<b>Tipo de Falta : </b>'+ response);
                },
                error: function() {
                    // Manejar errores si la solicitud AJAX falla
                    console.error('Error en la solicitud AJAX');
                }
            });
        });

        $('#type').on('change', function(){
            var type = $(this).val();

            if (type == 'Academica') {
                $('.container_learning').show();
            } else {
                $('.container_learning').hide();
            }
        });

        // Funcionalidad para duplicar el campo de Resultado de Aprendizaje
        $('#add-learningoutcome').on('click', function() {
            var newField = $('.learningoutcome-select:first').clone();
            newField.val(''); // Resetear el valor seleccionado
            newField.appendTo('.learning'); // Añadir el nuevo campo al contenedor
            newField.select2(); // Re-inicializar select2 en el nuevo campo
        });

        // Función para agregar fila de resultado de aprendizaje
        $(document).on('click', '.add_learning_outcomes', function() {
            var newRowHtml = `
                <div class="row align-items-center learning_outcomes_row">
                    <div class="col-8">
                        <div class="form-group">
                            {!! Form::label('learning_outcome',  trans('Resultados de Aprendizaje')) !!}
                            {!! Form::select('learning_outcome_id[]', [], old('learning_outcome_id[]'), ['class' => 'form-control select2 learning_outcome_select', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary add_learning_outcomes"><i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-danger delete-row"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
            $('#learning_outcomes_container').append(newRowHtml); // Agregar nueva fila al contenedor
            $('.select2').select2(); // Reinicializa Select2 en el nuevo selector
            
            // Obtener resultados de aprendizaje para el nuevo select
            getLearningOutcomesForNewRow();
        });

        // Función para eliminar fila de resultado de aprendizaje
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.learning_outcomes_row').remove();
        });

        // Obtener resultados de aprendizaje por competencia
        $('.competencies').on('change', function() {
            // Eliminar todas las filas de resultados de aprendizaje excepto la original
            $('#learning_outcomes_container .learning_outcomes_row:not(:first)').remove();
            
            // Obtener resultados de aprendizaje para la nueva fila
            getLearningOutcomesForNewRow();
        });


        // Función para obtener los resultados de aprendizaje para la nueva fila
        function getLearningOutcomesForNewRow() {
            var competencie_id = $('#competencies').val();
            console.log(competencie_id);

            if (competencie_id) {
                $.ajax({
                    url: '{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.filterlearning') }}',
                    method: 'GET',
                    data: {
                        competencie_id: competencie_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.learning_outcome) {
                            
                            var learning_outcomeSelect = $('.learning_outcome_select').last();
                            learning_outcomeSelect.empty();
                            $.each(response.learning_outcome, function(id , name) {
                                learning_outcomeSelect.append(new Option(name, id));
                            });
                        }
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
            }
        }
    });
</script>
@endpush
