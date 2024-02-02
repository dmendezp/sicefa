@extends('dicsena::layouts.master')
@section('css')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    @include('dicsena::layouts.partials.navbar')
</nav>

<div class="container">
    <h1 align="center">Guidepost</h1>
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('dicsena.instructor.guidepost.create') }}" class="btn btn-primary">Create Guide</a>
        @if (session('success'))
        <div class="alert alert-success ml-3">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <table id="tblguide" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">Title</th>
                <th>Description</th>
                <th>Program</th>
                <th>Pdf</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guideposts as $guidepost)
            <tr>
                <td>{{ $guidepost->title }}</td>
                <td>{{ $guidepost->description }}</td>
                <td>{{ $guidepost->program->name }}</td>
                <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $guidepost->url }}"><i class="fa-solid fa-file-pdf"></i></td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('dicsena.instructor.guidepost.edit', $guidepost->id) }}" class="btn btn-sm btn-primary mr-2">
                            <i id="lol" class="fas fa-edit"></i>
                        </a>
                        <div style="width: 10px;"></div>
                        <form action="{{ route('dicsena.instructor.guidepost.destroy', $guidepost->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this guide?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{ asset('libs/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('Datatables-1.13.4/datatables.js') }}"></script>
    <script>
        new DataTable('#tblguide');
    </script>
    @endsection