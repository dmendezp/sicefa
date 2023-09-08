@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Formulario</h1>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('bienestar.add_question') }}" class="btn btn-success mb-3">Añadir Pregunta</a>
                <form method="POST" action="{{ route('bienestar.saveform') }}" id="mainForm">
                    @csrf
                    <!-- Aquí van los checkbox y otras partes del formulario principal -->
                    
                </form>

                @foreach ($questions as $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <input type="checkbox" name="preguntas_seleccionadas[]" id="pregunta{{ $question->id }}" class="mr-2">
                                <label for="pregunta{{ $question->id }}">Seleccionar Pregunta</label>

                            </div>
                            <div>
                                <button class="btn btn-primary editButton" data-toggle="modal" data-target="#editModal{{$question->id}}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteModal{{$question->id}}"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="nombre">Pregunta:</label>
                                <input type="text" class="form-control" id="nombre" value="{{ $question->question }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tipo_pregunta">Respuestas:</label>
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
                                <h5 class="modal-title" id="editModalLabel{{$question->id}}">Editar Pregunta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm{{$question->id}}" action="{{ route('bienestar.editform.update', ['id' => $question->id]) }}" method="POST">
                                    @csrf
                                    <!-- Campos de edición aquí -->
                                    <div class="form-group">
                                        <label for="editName{{$question->id}}">Pregunta</label>
                                        <input type="text" class="form-control" id="editName{{$question->id}}" name="name" value="{{ $question->question }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="editPorcentaje{{$question->id}}">Respuestas:</label>
                                        @foreach ($answers as $answer)
                                        @if ($answer->question_id == $question->id)
                                        <input type="text" class="form-control" id="editRespuesta{{$answer->id}}" name="respuestas[{{$answer->id}}]" value="{{ $answer->answer }}"><br>
                                        @endif
                                        @endforeach
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" form="editForm{{$question->id}}" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- Modal para eliminar -->
                            <div class="modal fade" id="deleteModal{{$question->id}}" aria-labelledby="deleteModalLabel{{$question->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{$question->id}}">Eliminar Pregunta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de que deseas eliminar esta pregunta y sus respuestas?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('bienestar.delete_question', ['id' => $question->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                @endforeach
                <button type="submit" form="mainForm" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
@endsection
