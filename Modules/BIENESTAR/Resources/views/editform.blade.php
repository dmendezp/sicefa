@php
$role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp
@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.saveform.editform'))
    <form method="POST" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.saveform.editform') }}" id="mainForm" class="formGuardar">
        @csrf
        <h1 class="mb-4">{{ trans('bienestar::menu.Edit Form')}} <i class="fas fa-clipboard-list"></i></h1>
        <div class="card">
            <div class="card-body">
                <select class="form-control" id="id_convocation" name="convocatoria_id">
                    <option value="">{{ trans('bienestar::menu.Choose a call for proposals')}}</option>
                    @foreach ($convocations as $con)
                    <option value="{{ $con->id }}">{{ $con->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.add_question.editform'))
                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.add_question.editform') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus-circle"></i> {{ trans('bienestar::menu.Add Question')}}
                </a>
                @endif
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
                            @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.buttons.editform'))
                            <div class="d-flex">
                                <a class="btn btn-primary mr-2 editQuestion" data-question-id="{{ $question->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.question.editform', ['id' => $question->id]) }}" class="btn btn-danger formEliminar" data-method="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            @endif
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
    @endif
</div>
@foreach ($questions as $question)
<div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel{{ $question->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuestionModalLabel{{ $question->id }}">Editar Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.editform'))
                <form id="editForm{{ $question->id }}" name="editForm{{ $question->id }}" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.editform', ['id' => $question->id]) }}" method="POST" class="formEditar">
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
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="editRespuesta{{ $answer->id }}" name="answer[{{ $answer->id }}]" value="{{ $answer->answer }}"><br>
                            <div class="input-group-append">
                                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.delete.answer.editform', ['id' => $answer->id]) }}" class="btn btn-danger formEliminar" data-method="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button type="submit" form="editForm{{$question->id}}" class="btn btn-success">{{ trans('bienestar::menu.Save')}}</button>
                    </div>
                </form>
                <div class="form-group">
                    <form action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.add.answer.editform')}}" method="POST" class="formGuardar">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="answer" id="answer" class="form-control" placeholder="Agregar Una Nueva respuesta">
                            <input type="hidden" name="id_question" id="id_question" value="{{ $question->id }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success" id="saveAnswer">+</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                @endif
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
            var editFormAction = "{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit.editform', ':id') }}".replace(':id', questionId);
            var editedQuestionText = $(this).closest("div.card-body").find("input#nombre").val().trim();

            // Configura el formulario de edición del modal
            $("#editForm" + questionId).attr("action", editFormAction);
            $("#editedQuestion" + questionId).val(editedQuestionText);

            // Abre el modal correspondiente
            $("#editQuestionModal" + questionId).modal("show");
        });

        // Resto del código
    });
    $(document).ready(function() {
        var respuestaCount = 1;
        // Manejar clic en el botón "Agregar Respuesta"
        $('#agregarRespuesta').click(function() {
            respuestaCount++;

            // Crear un nuevo campo de respuesta con un ID único
            var nuevaRespuesta = '<div id="respuestaContainer' + respuestaCount + '" class="input-group mb-3">' +
                '<input id="respuestaInput' + respuestaCount + '" type="text" name="respuestas[]" class="form-control">' +
                '<div class="input-group-append">' +
                '<button class="btn btn-danger" type="button" onclick="borrarInput(' + respuestaCount + ')"><i class="fas fa-trash-alt"></i></button>' +
                '</div>' +
                '</div>';

            // Agregar el nuevo campo de respuesta al contenedor de respuestas
            $('#respuestas').append(nuevaRespuesta);
        });
    });
    $(document).ready(function() {
        // Manejador de evento para el envío del formulario principal
        $("#mainForm").submit(function(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();

            // Obtiene todos los checkboxes seleccionados
            var selectedCheckboxes = $("input[name='selected_questions[]']:checked");

            // Obtiene el valor seleccionado del select
            var convocationValue = $("#id_convocation").val();

            // Crea un array para almacenar los IDs de las preguntas seleccionadas
            var selectedQuestionIds = [];
            selectedCheckboxes.each(function() {
                selectedQuestionIds.push($(this).attr('id').replace('pregunta', ''));
            });

            // Verifica si al menos un checkbox está seleccionado y hay una convocatoria seleccionada
            if (selectedCheckboxes.length > 0 && convocationValue) {
                // Agrega los IDs de las preguntas al campo del formulario
                $("<input />").attr("type", "hidden")
                    .attr("name", "selected_questions")
                    .attr("value", selectedQuestionIds.join(','))
                    .appendTo("#mainForm");

                // Si se cumplen ambas condiciones, muestra el SweetAlert y envía el formulario principal
                showSweetAlert('success', 'Formulario Válido', 'Enviar formulario principal', 1500);
                this.submit();
            } else {
                // Muestra mensajes de error si alguna de las condiciones no se cumple
                if (selectedCheckboxes.length === 0) {
                    showSweetAlert('error', 'Error', 'Debe seleccionar al menos una pregunta', 3000);
                }
                if (!convocationValue) {
                    showSweetAlert('error', 'Error', 'Debe seleccionar una convocatoria', 3000);
                }
            }
        });

        // Configura el evento para el formulario de guardar
        document.querySelectorAll('.formGuardar').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe de inmediato
                var createForm = this;

                // Realizar una solicitud AJAX para enviar el formulario de creación
                axios.post(createForm.action, new FormData(createForm))
                    .then(function(response) {
                        if (response.status === 200) {
                            if (response.data.success) {
                                showSweetAlert('success', "{{ trans('bienestar::menu.Success!') }}", response.data.success, 1500);
                            } else {
                                showSweetAlert('error', 'Error', "{{ trans('bienestar::menu.An error occurred while trying to edit.') }}", 3000);
                            }
                        }
                    });
            });
        });
    });
</script>
@endsection