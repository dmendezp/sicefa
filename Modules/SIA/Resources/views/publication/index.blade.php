@extends('sia::layouts.master')

@section('content')
    <div class="container">
        <h3>Gestión de Publicaciones</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPublicationModal">
                <i class="fas fa-plus"></i> Crear Nueva Publicación
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Autor</th>
                            <th>Estado</th>
                            <th>PDF</th>
                            <th>Imagen</th>
                            <th>Fecha Publicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($publications as $publication)
                            <tr>
                                <td>{{ $publication->title }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#descriptionModal{{ $publication->id }}">
                                        Ver descripción
                                    </button>
                                </td>
                                <td>{{ $publication->author->full_name }}</td>
                                <td>
                                    <span
                                        class="badge 
                                    @if ($publication->status == 'Pendiente') bg-warning
                                    @elseif($publication->status == 'Publicada') bg-success
                                    @else bg-danger @endif">
                                        {{ $publication->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ asset($publication->pdf_path) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        Ver PDF
                                    </a>
                                </td>
                                <td>
                                    @if ($publication->image)
                                        <a href="{{ asset($publication->image) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            Ver Imagen
                                        </a>
                                    @else
                                        <small>-</small>
                                    @endif
                                </td>
                                <td>{{ $publication->publication_date }}</td>
                                <td>
                                    @if ($publication->status == 'Pendiente')
                                        <!-- Botón Aceptar -->
                                        <form action="{{ route('sia.admin.publication.update', $publication->id) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Publicada">
                                            <button class="btn btn-success btn-sm">Aprobar</button>
                                        </form>

                                        <!-- Botón Rechazar abre modal -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#rejectPublicationModal{{ $publication->id }}">
                                            Rechazar
                                        </button>
                                    @else
                                        <em>Sin acciones</em>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal Descripción -->
                            <div class="modal fade" id="descriptionModal{{ $publication->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Descripción de la Publicación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $publication->description }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Rechazo -->
                            <div class="modal fade" id="rejectPublicationModal{{ $publication->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('sia.admin.publication.update', $publication->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Rechazada">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Rechazar Publicación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Indica una observación para el autor:</p>
                                                <textarea name="reviewer_comments" class="form-control" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay publicaciones registradas.</td>
                            </tr>
                        @endforelse
                        <!-- Modal Crear Publicación -->
                        <div class="modal fade" id="createPublicationModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('sia.admin.publication.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Crear Nueva Publicación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Título *</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descripción *</label>
                                                <textarea name="description" class="form-control" rows="4" required></textarea>
                                            </div>

                                            <!-- Autor oculto -->
                                            <input type="hidden" name="author_id" value="{{ auth()->user()->person_id }}">

                                            <div class="mb-3">
                                                <label for="publication_date" class="form-label">Fecha de Publicación
                                                    *</label>
                                                <input type="date" name="publication_date" class="form-control"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="pdf" class="form-label">Archivo PDF *</label>
                                                <input type="file" name="pdf" accept="application/pdf"
                                                    class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="image" class="form-label">Imagen (opcional)</label>
                                                <input type="file" name="image" accept="image/*"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Guardar Publicación</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
