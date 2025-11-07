{{-- Modal Crear Proyecto Formativo --}}
<div class="modal fade" id="crearproyecto" tabindex="-1" aria-labelledby="crearproyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{ trans('Agregar Proyecto Formativo')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sigac.academic_coordination.curriculum_planning.training_project.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Ingrese el nombre', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('code', 'Codigo') !!}
                    {!! Form::number('code', null, ['class' => 'form-control','placeholder' => 'Ingrese el codigo', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('execution_time', 'Tiempo de ejecucion (Meses)') !!}
                    {!! Form::number('execution_time', null, ['class' => 'form-control','placeholder' => 'Ingrese el número de meses de ejecucion', 'required']) !!}
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
    </div>
</div>
<script>
    $(document).ready(function() {
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