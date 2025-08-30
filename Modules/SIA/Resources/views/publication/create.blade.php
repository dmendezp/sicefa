@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3>Mis Publicaciones</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Formulario Nueva Publicación -->
    <div class="card mb-4">
        <div class="card-header">Nueva Publicación</div>
        <div class="card-body">
            <form action="{{ route('sia.apprentice.publication.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Título</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Archivo PDF</label>
                    <input type="file" name="pdf_file" accept="application/pdf" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Imagen (opcional)</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Fecha de Publicación</label>
                    <input type="date" name="publication_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Enviar Publicación</button>
            </form>
        </div>
    </div>

    <!-- Historial de Publicaciones -->
    <div class="card">
        <div class="card-header">Historial</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Fecha Publicación</th>
                        <th>Revisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publications as $publication)
                        <tr>
                            <td>{{ $publication->title }}</td>
                            <td>
                                <span class="badge 
                                    @if($publication->status == 'Pendiente') bg-warning
                                    @elseif($publication->status == 'Publicada') bg-success
                                    @else bg-danger @endif">
                                    {{ $publication->status }}
                                </span>
                            </td>
                            <td>{{ $publication->publication_date }}</td>
                            <td>
                                @if($publication->reviewer_comments)
                                    <small><strong>Observación:</strong> {{ $publication->reviewer_comments }}</small>
                                @else
                                    <small>-</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ asset($publication->pdf_path) }}" target="_blank" class="btn btn-sm btn-primary">Ver PDF</a>
                                @if($publication->image)
                                    <a href="{{ asset($publication->image) }}" target="_blank" class="btn btn-sm btn-info">Ver Imagen</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No tienes publicaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
