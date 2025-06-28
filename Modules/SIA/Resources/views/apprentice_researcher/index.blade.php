@extends('adminlte::page')

@section('title', 'Aprendices Investigadores')

@section('content_header')
    <h1>Aprendices Investigadores</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-{{ session('typealert') }}">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Aprendices Investigadores</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('sia.apprentice_researchers.create') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-user-plus"></i> Registrar Nuevo Aprendiz Investigador
                        </a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>Email</th>
                                    <th>Programa</th>
                                    <th>Curso</th>
                                    <th>Grupo</th>
                                    <th>Proyecto</th>
                                    <th>Institución</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apprentices as $apprentice)
                                    <tr>
                                        <td>{{ $apprentice->person->full_name }}</td>
                                        <td>{{ $apprentice->user->email }}</td>
                                        <td>{{ $apprentice->program->name ?? 'N/A' }}</td>
                                        <td>{{ $apprentice->course->name ?? 'N/A' }}</td>
                                        <td>{{ $apprentice->group->name ?? 'N/A' }}</td>
                                        <td>{{ $apprentice->project->name ?? 'N/A' }}</td>
                                        <td>{{ $apprentice->institution }}</td>
                                        <td>
                                            <a href="{{ route('sia.apprentice_researchers.edit', $apprentice->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('sia.apprentice_researchers.destroy', $apprentice->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este aprendiz investigador?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection