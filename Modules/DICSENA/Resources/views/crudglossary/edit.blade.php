@extends('dicsena::layouts.master')

@section('content')
<div class="container">
    <h1>Editar Glosario</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('cefa.dicsena.glossary.update', $glossary->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="word">Palabra:</label>
            <input type="text" name="word" id="word" class="form-control" value="{{ $glossary->word }}" required>
        </div>
        <div class="form-group">
            <label for="word">Traduction:</label>
            <input type="text" name="traduction" id="traduction" class="form-control" value="{{ $glossary->traduction }}" required>
        </div>
        <div class="form-group">
            <label for="meaning">Significado:</label>
            <input type="text" name="meaning" id="meaning" class="form-control" value="{{ $glossary->meaning }}" required>
        </div>
        <div class="form-group">
            <label for="program_id">Programa:</label>
            <select name="program_id" id="program_id" class="form-control" required>
                @foreach ($programs as $program)
                <option value="{{ $program->id }}" {{ $program->id == $glossary->program_id ? 'selected' : '' }}>{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection