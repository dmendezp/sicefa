@extends('dicsena::layouts.master')
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    @include('dicsena::layouts.partials.navbar')
</nav>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Create Glossary</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('dicsena.instructor.glossary.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="word">Word:</label>
                            <input type="text" name="word" id="word" class="form-control" style="width: 100%;" required>
                        </div>
                        <div class="form-group">
                            <label for="traduction">Translation:</label>
                            <input type="text" name="traduction" id="traduction" class="form-control" style="width: 100%;" required>
                        </div>
                        <div class="form-group">
                            <label for="meaning">Meaning:</label>
                            <input type="text" name="meaning" id="meaning" class="form-control" style="width: 100%;" required>
                        </div>
                        <div class="form-group">
                            <label for="program_id">Program:</label>
                            <select name="program_id" id="program_id" class="form-control" style="width: 100%;" required>
                                @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection