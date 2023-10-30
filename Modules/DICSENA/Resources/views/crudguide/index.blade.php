@extends('dicsena::layouts.master')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('dicsena.instructor.guidepost.create') }}" class="btn btn-primary mb-3">Create Guidepost</a>

<table id="tblguide" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">

    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">Title</th>
            <th>{{trans ('dicsena::menu.Description)}}</th>
            <th>Program</th>
            <th>Pdf</th>
            <th>Actions</th>
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
                        <i class="fas fa-edit"></i>
                    </a>
                    <div style="width: 10px;"></div>
                    <form action="{{ route('dicsena.instructor.guidepost.destroy', $guidepost->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta guia?')">
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
<footer style="background-color: #3C3B6E; color: white; padding: 20px;">
    <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
    <p style="text-align: center;">&copy; 2023</p>
</footer>
@endsection