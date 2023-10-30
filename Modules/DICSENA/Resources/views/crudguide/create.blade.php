@extends('dicsena::layouts.master')

@section('content')
<h1>Create Guidepost</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('dicsena.instructor.guidepost.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="program_id">Program</label>
        <select name="program_id" id="program_id" class="form-control" required>
            @foreach ($programs as $program)
            <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="url">File</label>
        <input type="file" name="url" id="url" class="form-control-file" required>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection