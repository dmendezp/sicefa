@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <h1>Editar Formulario</h1><br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                @foreach ($questions as $question)
                <div class="card">
                    <div class="card-body">
                        <form>
                            <input type="checkbox" id="checklist"><label for="">Seleccionar Pregunta</label>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" value="{{ $question->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_pregunta">Tipo de Pregunta:</label>
                                    <input type="text" class="form-control" id="tipo_pregunta" value="{{ $question->type_question }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="puntaje">Puntaje:</label>
                                    <input type="text" class="form-control" id="puntaje" value="{{ $question->score }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection