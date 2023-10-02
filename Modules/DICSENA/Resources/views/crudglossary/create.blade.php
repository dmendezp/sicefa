@extends('dicsena::layouts.master')
@section('content')
<div class="container">
    <h1>Crear Glosario</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('cefa.dicsena.glossary.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="word">Palabra:</label>
            <input type="text" name="word" id="word" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="word">Traduccion:</label>
            <input type="text" name="traduction" id="traduction" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="meaning">Significado:</label>
            <input type="text" name="meaning" id="meaning" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="program_id">Programa:</label>
            <select name="program_id" id="program_id" class="form-control" required>
                @foreach ($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection