@extends('bienestar::layouts.adminlte')

@section('title', 'Editar Formulario')

@section('content_header')
    <h1>Editar Formulario</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Preguntas Disponibles</h3>
            </div>
            <div class="card-body">
                <form id="available-questions-form" action="{{ route('bienestar.editform.add') }}" method="POST">
                    @csrf
                    <ul class="list-group">
                        <!-- Iterar a través de las preguntas disponibles -->
                        @foreach ($availableQuestions as $question)
                            <li class="list-group-item">
                                <label>
                                    <input type="checkbox" name="selected_questions[]" value="{{ $question->id }}">
                                    {{ $question->text }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <button type="submit" class="btn btn-primary mt-3">Guardar Formulario</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Agregar la mitad derecha para editar el formulario -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@stop

