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
                    <h1>Edit Guidepost</h1>
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
                    <form action="{{ route('dicsena.instructor.guidepost.update', $guidepost->id) }}" method="POST" enctype="multipart/form-data">
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

                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection