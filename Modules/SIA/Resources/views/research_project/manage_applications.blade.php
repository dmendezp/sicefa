@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3>Gestión de Postulaciones a Proyectos</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped" id="management">
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Aprendiz</th>
                <th>Curso</th>
                <th>Estado</th>
                <th>Fecha Postulación</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{ $application->project->title }}</td>
                    <td>{{ $application->apprentice->person->full_name }}</td>
                    <td>{{ $application->apprentice->course->code }} - {{ $application->apprentice->course->program->name }}</td>
                    <td>
                        <span class="badge 
                            @if($application->status == 'Pendiente') bg-warning 
                            @elseif($application->status == 'Aprobado') bg-success 
                            @else bg-danger @endif">
                            {{ $application->status }}
                        </span>
                    </td>
                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($application->observation)
                            {{ $application->observation }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($application->status == 'Pendiente')
                        <!-- Aprobar -->
                        <form action="{{ route('sia.admin.research_project.applications.update', $application->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <input type="hidden" name="status" value="Aprobado">
                            <button class="btn btn-success btn-sm">Aprobar</button>
                        </form>

                        <!-- Botón abrir modal rechazar -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $application->id }}">
                            Rechazar
                        </button>

                        <!-- Modal rechazar -->
                        <div class="modal fade" id="rejectModal{{ $application->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('sia.admin.research_project.applications.update', $application->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Rechazado">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Rechazar Postulación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Observación</label>
                                                <textarea name="observation" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Rechazar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @else
                        <em>Sin acciones</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay postulaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#management').DataTable({
        });
    });
</script>
