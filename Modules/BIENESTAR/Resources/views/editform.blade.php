@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('cefa.bienestar.saveform') }}" id="mainForm">
        @csrf
        <h1 class="mb-4">{{ trans('bienestar::menu.Edit Form')}} <i class="fas fa-clipboard-list"></i></h1>
        <div class="card">
            <div class="card-body">
                <select class="form-control" id="id_convocatoria" name="convocatoria_id">
                    <option value="">{{ trans('bienestar::menu.Choose a call for proposals')}}</option>
                    @foreach ($convocations as $con)
                    <option value="{{ $con->id }}">{{ $con->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('cefa.bienestar.add_question') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus-circle"></i> {{ trans('bienestar::menu.Add Question')}}
                </a>
                <!-- Lista de preguntas -->
                @foreach ($questions as $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="selected_questions[]" id="pregunta{{ $question->id }}">
                                    <label class="form-check-label" for="pregunta{{ $question->id }}">{{ trans('bienestar::menu.Select Question')}}</label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-primary mr-2 editQuestion" data-question-id="{{ $question->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('cefa.bienestar.delete_question', ['id' => $question->id]) }}" class="btn btn-danger formEliminar2" data-method="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">{{ trans('bienestar::menu.Question')}}</label>
                            <input type="text" class="form-control" id="nombre" value="{{ $question->question }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tipo_pregunta">{{ trans('bienestar::menu.Answer')}}</label>
                            <div class="form-group">
                                <select class="form-control" id="tipo_pregunta" readonly>
                                    @foreach ($answers as $answer)
                                    @if ($answer->question_id == $question->id)
                                    <option value="{{ $answer->id }}">{{ $answer->answer }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="submit" form="mainForm" class="btn btn-success">{{ trans('bienestar::menu.Save')}}</button>
            </div>
        </div>
    </form>
</div>

<!-- Modales (uno por cada pregunta) -->
@foreach ($questions as $question)
<div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="editQuestionModalLabel{{ $question->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuestionModalLabel{{ $question->id }}">Editar Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $question->id }}" action="{{ route('cefa.bienestar.editform.update', ['id' => $question->id]) }}" method="POST">
                    @csrf
                    <!-- Campos de edición aquí -->
                    <div class="form-group">
                        <label for="editedQuestion">{{ trans('bienestar::menu.Question')}}</label>
                        <input type="text" class="form-control" id="editedQuestion" name="question" value="{{ $question->question }}">
                    </div>
                    <div class="form-group">
                        <label for="editedAnswer">{{ trans('bienestar::menu.Answer')}}</label>
                        @foreach ($answers as $answer)
                        @if ($answer->question_id == $question->id)
                        <input type="text" class="form-control" id="editRespuesta{{ $answer->id }}" name="answer[{{ $answer->id }}]" value="{{ $answer->answer }}"><br>
                        @endif
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="editForm{{$question->id}}" class="btn btn-success">{{ trans('bienestar::menu.Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
        // Abre el modal para editar una pregunta
        $(".editQuestion").on("click", function() {
            var questionId = $(this).data("question-id");
            var editFormAction = "{{ route('cefa.bienestar.editform.update', ':id') }}".replace(':id', questionId);
            var editedQuestionText = $(this).closest("div.card-body").find("input#nombre").val().trim();

            // Configura el formulario de edición del modal
            $("#editForm" + questionId).attr("action", editFormAction);
            $("#editedQuestion" + questionId).val(editedQuestionText);

            // Abre el modal correspondiente
            $("#editQuestionModal" + questionId).modal("show");
        });

        // Resto del código
    });
</script>
<script>
        $(document).ready(function() {
            // Manejador de evento para el envío del formulario
            $("#mainForm").submit(function(event) {
                // Evita que el formulario se envíe automáticamente
                event.preventDefault();

                // Obtiene todos los checkboxes seleccionados
                var selectedCheckboxes = $("input[name='selected_questions[]']:checked");

                // Verifica si al menos un checkbox está seleccionado
                if (selectedCheckboxes.length === 0) {
                    alert("Debes seleccionar al menos una pregunta.");
                    return;
                }

                // Prepara un arreglo para almacenar los IDs de las preguntas seleccionadas
                var selectedQuestionIds = [];
                selectedCheckboxes.each(function() {
                    selectedQuestionIds.push($(this).attr("id").replace("pregunta", ""));
                });

                // Agrega los IDs de las preguntas seleccionadas como un campo oculto en el formulario
                $("#mainForm").append('<input type="hidden" name="selected_question_ids" value="' + selectedQuestionIds.join(",") + '">');

                // Ahora, puedes enviar el formulario con los IDs de las preguntas seleccionadas
                this.submit();
            });
        });
    </script>
@endsection