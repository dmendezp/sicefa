@extends('bienestar::layouts.master')

@section('title', 'Editar Formulario')

@section('content_header')
<h1>{{ trans('bienestar::form.Edit_Form') }}</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.save.editform') }}" class="formGuardar">
                @csrf
                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.convocations.crud.editform')}}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i></a>
                <div class="form-group">
                    <label for="texto_pregunta">Pregunta</label>
                    <input type="text" name="text_question" class="form-control">
                </div>
                <div class="form-group">
                    <label for="type_benefit">Tipo de pregunta</label>
                    <select class="form-control" id="question_category" name="question_category" required>
                        <option value="">Elija una Categoria</option>
                        <option value="Alimentacion">Alimentación</option>
                        <option value="Transporte">Transporte</option>
                    </select>
                </div>
                <div class="form-group" id="respuestas">
                    <label for="respuestas">Respuestas</label>
                    <div class="input-group">
                        <input type="text" name="respuestas[]" class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success" id="agregarRespuesta">+</button>
                        </div>
                    </div><br>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Contador para el nombre de los campos de respuesta
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

        // Función para borrar el input y su contenedor
        window.borrarInput = function(respuestaCount) {
            // Obtener el contenedor del input mediante el ID único
            var container = $('#respuestaContainer' + respuestaCount);

            // Borrar el contenido del input
            container.find('input').val('');

            // Eliminar el contenedor completo
            container.remove();
        }
    });
</script>



@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@stop