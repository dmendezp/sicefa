@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Gestión de Eventos</h3>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Botón para abrir modal de crear evento -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createEventModal">
        Crear Nuevo Evento
    </button>

    <!-- Tabla de eventos -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Lugar</th>
                        <th>Organizador</th>
                        <th>Contacto</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->organizer }}</td>
                            <td>
                                <p>Email: {{ $event->contact_email }}</p>
                                <p>Tel: {{ $event->contact_phone ?? '-' }}</p>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge 
                                    @if($event->status == 'Programado') bg-info
                                    @elseif($event->status == 'Completado') bg-success
                                    @else bg-danger @endif">
                                    {{ $event->status }}
                                </span>
                            </td>
                            <td>
                                @if($event->event_image)
                                    <a href="{{ asset($event->event_image) }}" target="_blank" class="btn btn-sm btn-info">
                                        Ver Imagen
                                    </a>
                                @else
                                    <small>-</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay eventos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear Evento -->
    <div class="modal fade" id="createEventModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('sia.admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Nuevo Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campos -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Título *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción *</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="event_image" class="form-label">Imagen</label>
                            <input type="file" name="event_image" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Lugar *</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha y Hora de Inicio *</label>
                            <input type="datetime-local" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Fecha y Hora de Finalización *</label>
                            <input type="datetime-local" name="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="organizer" class="form-label">Organizador *</label>
                            <input type="text" name="organizer" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email de Contacto *</label>
                            <input type="email" name="contact_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Teléfono de Contacto (opcional)</label>
                            <input type="text" name="contact_phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado *</label>
                            <select name="status" class="form-select" required>
                                <option value="Programado">Programado</option>
                                <option value="Completado">Completado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar Evento</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
