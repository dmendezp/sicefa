<div class="modal fade modal-static" id="addTrimestralizacion" tabindex="-1" aria-labelledby="addCompetence" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Trimestralización</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.curriculum_planning.quarterlie.store', 'method' => 'POST']) !!}
                @csrf
                {!! Form::hidden('quarter_number',null , ['id' => 'trimestre_number_input']) !!}
                {!! Form::hidden('training_project_id', $trainingProjectId) !!}
                <div class="form-group">
                    {!! Form::label('competence','Competencia') !!}
                    {!! Form::select(
                        'competences',
                        $competences_select,
                        [],
                        ['class' => 'form-control competencies select2', 'placeholder' => 'Seleccione la competencia', 'id' => 'competencies', 'required']
                    ) !!}
                </div>
                <label for="learning_outcome_id">{{ trans('Resultados de Aprendizaje') }}</label>
                
                <!-- Resultado de Aprendizaje -->
                <div id="learning_outcomes_container">
                    <!-- Campo de selección de resultado de aprendizaje -->
                    <div class="row align-items-center learning_outcomes_row">
                        <div class="col-8">
                            <div class="form-group">
                                {!! Form::select('learning_outcome_id[]', [], old('learning_outcome_id[]'), ['class' => 'form-control select2 learning_outcome_select', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('hour', 'Horas') !!}
                                {!! Form::number('hour[]', null, ['class' => 'form-control','placeholder' => 'Ingrese el número horas', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary add_learning_outcomes"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <br>
                
                {!! Form::submit(trans('sigac::general.Btn_Save'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
           
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
                        <div class="form-group">
                            {!! Form::label('hour', 'Horas') !!}
                            {!! Form::number('hour[]', null, ['class' => 'form-control','placeholder' => 'Ingrese el número horas', 'required']) !!}
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
