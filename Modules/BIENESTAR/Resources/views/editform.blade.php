@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ trans('bienestar::menu.Edit Form')}}</h1>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('cefa.bienestar.add_question') }}" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i>{{ trans('bienestar::menu.Add Question')}}</a>
                <form method="POST" action="{{ route('cefa.bienestar.saveform') }}" id="mainForm">
                    @csrf
                    <!-- Aquí van los checkbox y otras partes del formulario principal -->                                                       

                @foreach ($questions as $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <input type="checkbox" name="preguntas_seleccionadas[]" id="pregunta{{ $question->id }}" class="mr-2">
                                <label for="pregunta{{ $question->id }}">{{ trans('bienestar::menu.Select Question')}}</label>

                            </div>
                            <div class="d-flex">
                                <a class="btn btn-primary mr-2" data-toggle="modal" data-target="#editModal{{$question->id}}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('cefa.bienestar.delete_question', ['id' => $question->id]) }}" method="POST" id="formEliminar" class="formEliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" form="formEliminar" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
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

                <!-- Modal para la edición -->
                <div class="modal fade" id="editModal{{$question->id}}" aria-labelledby="editModalLabel{{$question->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Contenido del modal de edición aquí -->

                            <!-- Aquí va el contenido del formulario de edición -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{$question->id}}">{{ trans('bienestar::menu.Edit Question')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm{{$question->id}}" action="{{ route('cefa.bienestar.editform.update', ['id' => $question->id]) }}" method="POST">
                                    @csrf
                                    <!-- Campos de edición aquí -->
                                    <div class="form-group">
                                        <label for="editName{{$question->id}}">{{ trans('bienestar::menu.Question')}}</label>
                                        <input type="text" class="form-control" id="editName{{$question->id}}" name="name" value="{{ $question->question }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="editPorcentaje{{$question->id}}">{{ trans('bienestar::menu.Answer')}}</label>
                                        @foreach ($answers as $answer)
                                        @if ($answer->question_id == $question->id)
                                        <input type="text" class="form-control" id="editRespuesta{{$answer->id}}" name="respuestas[{{$answer->id}}]" value="{{ $answer->answer }}"><br>
                                        @endif
                                        @endforeach
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" form="editForm{{$question->id}}" class="btn btn-primary">{{ trans('bienestar::menu.Save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="submit" form="mainForm" class="btn btn-primary">{{ trans('bienestar::menu.Save')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Manejador de evento para el envío del formulario
    $("#mainForm").submit(function(event) {
        // Evita que el formulario se envíe automáticamente
        event.preventDefault();

        // Obtiene todos los checkboxes seleccionados
        var selectedCheckboxes = $("input[name='preguntas_seleccionadas[]']:checked");

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