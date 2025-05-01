@extends('pserenacefa::layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Listado de Ambientes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Ubicación</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($environments1 as $ambiente)
                <tr>
                    <td>{{ $ambiente->id }}</td>
                    <td>{{ $ambiente->name }}</td>
                    <td>{{ $ambiente->capacity }}</td>
                    <td>{{ $ambiente->location }}</td>
                    <td>{{ $ambiente->description }}</td>
                    <td>{{ $ambiente->status }}</td>
                    <td>
                        <!-- Botón para abrir modal de editar -->
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $ambiente->id }}">Editar</button>

                        <!-- Botón para abrir modal de eliminar -->
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $ambiente->id }}">Eliminar</button>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editModal{{ $ambiente->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $ambiente->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{ route('pserenacefa.admin.admin.update', $ambiente->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Ambiente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" name="name" value="{{ $ambiente->name }}" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Capacidad</label>
                                        <input type="number" name="capacity" value="{{ $ambiente->capacity }}" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Ubicación</label>
                                        <input type="text" name="location" value="{{ $ambiente->location }}" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea name="description" class="form-control">{{ $ambiente->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select name="status" class="form-control" required>
                                            <option value="Disponible" {{ $ambiente->status == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                            <option value="No Disponible" {{ $ambiente->status == 'No Disponible' ? 'selected' : '' }}>No Disponible</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Eliminar -->
                <div class="modal fade" id="deleteModal{{ $ambiente->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $ambiente->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{ route('pserenacefa.admin.admin.destroy', $ambiente->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmar Eliminación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar el ambiente <strong>{{ $ambiente->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr><td colspan="7">No hay ambientes registrados aún.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection