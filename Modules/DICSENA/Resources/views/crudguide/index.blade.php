@extends('dicsena::layouts.master')

@section('content')
<h1>Guideposts</h1>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('cefa.dicsena.guidepost.create') }}" class="btn btn-primary mb-3">Create Guidepost</a>

<table id="index" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">

    <thead class="bg-primary text-white">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Program</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guideposts as $guidepost)
        <tr>
            <td>{{ $guidepost->title }}</td>
            <td>{{ $guidepost->description }}</td>
            <td>{{ $guidepost->program->name }}</td>
            <td>
                <a href="{{ route('cefa.dicsena.guidepost.edit', $guidepost->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('cefa.dicsena.guidepost.destroy', $guidepost->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection