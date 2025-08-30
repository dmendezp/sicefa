@extends('sia::layouts.master')

@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Proyecto Investigacion</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto custom-border-color">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Botón para abrir modal de nuevo proyecto -->
            <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                Nuevo Proyecto
            </button>

            <!-- Tabla de proyectos -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fechas</th>
                            <th>Responsable</th>
                            <th>PDF</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ Str::limit($project->description, 50) }}</td>
                                <td>{{ $project->state }}</td>
                                <td>{{ $project->start_date }} - {{ $project->end_date }}</td>
                                <td>{{ $project->person->full_name ?? 'N/A' }}</td>
                                <td>
                                    @if ($project->pdf_report_path)
                                        <a href="{{ url($project->pdf_report_path) }}" target="_blank">Ver PDF</a>

                                    @else
                                        Sin PDF
                                    @endif
                                </td>
                                <td>
                                    <!-- Botón Editar -->
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editProjectModal{{ $project->id }}">
                                        Editar
                                    </button>

                                    <!-- Botón Eliminar -->
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteProjectModal{{ $project->id }}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('sia.admin.research_project.update', $project->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Proyecto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Campos -->
                                                <div class="mb-3">
                                                    <label>Título</label>
                                                    <input type="text" name="title" class="form-control"
                                                        value="{{ $project->title }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Descripción</label>
                                                    <textarea name="description" class="form-control" required>{{ $project->description }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Estado</label>
                                                    <select name="estado" class="form-control">
                                                        <option {{ $project->estado == 'En Curso' ? 'selected' : '' }}>En
                                                            Curso</option>
                                                        <option {{ $project->estado == 'Finalizado' ? 'selected' : '' }}>
                                                            Finalizado</option>
                                                        <option {{ $project->estado == 'Cancelado' ? 'selected' : '' }}>
                                                            Cancelado</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Fecha Inicio</label>
                                                    <input type="date" name="start_date" class="form-control"
                                                        value="{{ $project->start_date }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Fecha Fin</label>
                                                    <input type="date" name="end_date" class="form-control"
                                                        value="{{ $project->end_date }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Responsable</label>
                                                    <select name="person_id" class="form-control person_id"
                                                        style="width: 100%"></select>


                                                </div>

                                                <div class="mb-3">
                                                    <label>Informe PDF (opcional)</label>
                                                    <input type="file" name="pdf_report" class="form-control"
                                                        accept="application/pdf">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Eliminar -->
                            <div class="modal fade" id="deleteProjectModal{{ $project->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('sia.admin.research_project.destroy', $project->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar Proyecto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Estás seguro de eliminar <strong>{{ $project->title }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay proyectos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Crear -->
        <div class="modal fade" id="createProjectModal" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('sia.admin.research_project.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nuevo Proyecto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos -->
                            <div class="mb-3">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Descripción</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Estado</label>
                                <select name="estado" class="form-control">
                                    <option>En Curso</option>
                                    <option>Finalizado</option>
                                    <option>Cancelado</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Fecha Inicio</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Fecha Fin</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                {!! Form::label('person_id', 'Responsable') !!}
                                <select name="person_id" class="form-control person_id" style="width: 100%"></select>

                            </div>

                            <div class="mb-3">
                                <label>Informe PDF (opcional)</label>
                                <input type="file" name="pdf_report" class="form-control" accept="application/pdf">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Crear</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('select.person_id').select2({
            placeholder: 'Seleccione una persona',
            minimumInputLength: 3,
            dropdownParent: $('#createProjectModal'), // 👈 o el ID del modal actual
            ajax: {
                url: '{{ route('sia.admin.searchperson') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.text
                            };
                        })
                    };
                },
                cache: true
            }
        });

    });
</script>
