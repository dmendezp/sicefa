@extends('sia::layouts.master')

@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">Alianzas</li>
@endpush

@section('content')
<div class="card card-success card-outline col-12 mx-auto custom-border-color">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Botón para abrir modal de nueva alianza -->
        <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#createAllianceModal">
            Nueva Alianza
        </button>

        <!-- Tabla de alianzas -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Organización</th>
                        <th>Email</th>
                        <th>Fechas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alliances as $alliance)
                        <tr>
                            <td>{{ $alliance->name }}</td>
                            <td>{{ Str::limit($alliance->description, 50) }}</td>
                            <td>{{ $alliance->organization }}</td>
                            <td>{{ $alliance->email }}</td>
                            <td>{{ $alliance->start_date }} - {{ $alliance->end_date ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $alliance->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($alliance->status) }}
                                </span>
                            </td>
                            <td>
                                <!-- Botón Editar -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editAllianceModal{{ $alliance->id }}">
                                    Editar
                                </button>

                                <!-- Botón Eliminar -->
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteAllianceModal{{ $alliance->id }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editAllianceModal{{ $alliance->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('sia.admin.alliance.update', $alliance->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Alianza</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Campos -->
                                            <div class="mb-3">
                                                <label>Nombre</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $alliance->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Descripción</label>
                                                <textarea name="description" class="form-control" required>{{ $alliance->description }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label>Organización</label>
                                                <input type="text" name="organization" class="form-control"
                                                    value="{{ $alliance->organization }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $alliance->email }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Fecha Inicio</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    value="{{ $alliance->start_date }}">
                                            </div>

                                            <div class="mb-3">
                                                <label>Fecha Fin</label>
                                                <input type="date" name="end_date" class="form-control"
                                                    value="{{ $alliance->end_date }}">
                                            </div>

                                            <div class="mb-3">
                                                <label>Estado</label>
                                                <select name="status" class="form-control">
                                                    <option value="active" {{ $alliance->status == 'active' ? 'selected' : '' }}>Activo</option>
                                                    <option value="inactive" {{ $alliance->status == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                                                </select>
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
                        <div class="modal fade" id="deleteAllianceModal{{ $alliance->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('sia.admin.alliance.destroy', $alliance->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Eliminar Alianza</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro de eliminar <strong>{{ $alliance->name }}</strong>?</p>
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
                            <td colspan="7" class="text-center">No hay alianzas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="createAllianceModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('sia.admin.alliance.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva Alianza</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campos -->
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Organización</label>
                            <input type="text" name="organization" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
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
                            <label>Estado</label>
                            <select name="status" class="form-control">
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Crear</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
