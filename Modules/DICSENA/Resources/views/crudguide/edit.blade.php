@extends('dicsena::layouts.master')

@section('content')
    <h1>Edit Guidepost</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cefa.dicsena.update', $guidepost->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $guidepost->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $guidepost->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="program_id">Program</label>
            <select name="program_id" id="program_id" class="form-control" required>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}" @if ($program->id == $guidepost->program_id) selected @endif>{{ $program->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="url">File</label>
            <input type="file" name="url" id="url" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection