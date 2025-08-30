@extends('sia::layouts.master')

@section('content')
<div class="container">
    <h3>Grupos de Aprendices por Semillero</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filtro de Proyecto --}}
    <form method="GET" action="{{ route('sia.admin.research_project.group') }}" class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <label for="project_id">Seleccionar Proyecto</label>
                <select name="project_id" id="project_id" class="form-control" required>
                    <option value=""> Seleccione un proyecto </option>
                    @foreach($projects as $projectOption)
                        <option value="{{ $projectOption->id }}"
                            {{ request('project_id') == $projectOption->id ? 'selected' : '' }}>
                            {{ $projectOption->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Ver Grupo</button>
            </div>
        </div>
    </form>

    {{-- Mostrar solo si hay proyecto seleccionado --}}
    @isset($project)
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Semillero:</strong> {{ $project->title }}</p>
                <p><strong>Estado:</strong> {{ $project->state }}</p>
                <p><strong>Fechas:</strong> {{ $project->start_date }} - {{ $project->end_date }}</p>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="group_table">
            <thead>
                <tr>
                    <th>Aprendiz</th>
                    <th>Documento</th>
                    <th>Curso</th>
                    <th>Correo</th>
                    <th>Estado Postulación</th>
                    <th>Observación</th>
                    <th>Fecha Postulación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->apprentice->person->full_name }}</td>
                        <td>{{ $application->apprentice->person->document_number }}</td>
                        <td>{{ $application->apprentice->course->code }} - {{ $application->apprentice->course->program->name }}</td>
                        <td>{{ $application->apprentice->person->users->first()->email }}</td>
                        <td>
                            <span class="badge 
                                @if($application->status == 'Pendiente') bg-warning 
                                @elseif($application->status == 'Aprobado') bg-success 
                                @else bg-danger @endif">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ $application->observation ?? '-' }}</td>
                        <td>{{ $application->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('sia.admin.research_project.applications.detach', $application->id) }}"
                                method="POST" onsubmit="return confirm('¿Está seguro de desasociar este aprendiz?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Desasociar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay aprendices asociados a este semillero.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endisset
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#group_table').DataTable({
        });
    });
</script>
