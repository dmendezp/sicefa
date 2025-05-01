@extends('lombrisoft::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3 text-end">
                <a href="{{ route('camas.create') }}" class="btn btn-primary">Crear Nueva Cama</a>
            </div>
            <div class="card shadow-lg rounded">
                <div class="card-header bg-success text-white text-center">
                    <h4>Listado de Camas</h4>
                </div>
                <div class="card-body">
                    @if ($camas->isEmpty())
                        <div class="alert alert-info text-center">
                            No hay camas registradas.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Número de Cama</th>
                                        <th>Estado</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($camas as $cama)
                                        <tr>
                                            <td>{{ $cama->id }}</td>
                                            <td>{{ $cama->number }}</td>
                                            <td>{{ $cama->status }}</td>
                                            <td>{{ $cama->start_date }}</td>
                                            <td class="text-center">
    <!-- Botón para abrir el modal de edición -->
    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal" 
        data-id="{{ $cama->id }}" 
        data-number="{{ $cama->number }}" 
        data-status="{{ $cama->status }}" 
        data-start_date="{{ $cama->start_date }}">
        Editar
    </button>
    <form action="{{ route('camas.destroy', $cama->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger" onclick="confirmarEliminacion(this)">Eliminar</button>
    </form>
</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Cama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNumero" class="form-label">Número de la Cama</label>
                        <input type="number" class="form-control" id="editNumero" name="numero" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEstado" class="form-label">Estado</label>
                        <select class="form-select" id="editEstado" name="estado" required>
                            <option value="Disponible">Disponible</option>
                            <option value="Ocupada">Ocupada</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editFechaInicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="editFechaInicio" name="fecha_inicio" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editModal');

        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const number = button.getAttribute('data-number');
            const status = button.getAttribute('data-status');
            const startDate = button.getAttribute('data-start_date');

            const form = document.getElementById('editForm');
            form.action = `/lombrisoft/admin/camas/${id}`;
            document.getElementById('editNumero').value = number;
            document.getElementById('editEstado').value = status;
            document.getElementById('editFechaInicio').value = startDate;
        });
    });
    function confirmarEliminacion(element) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Envía el formulario
                element.closest('form').submit();
            }
        });
    }

    // Alternativa simple si no tienes SweetAlert
    function confirmarEliminacionSimple(element) {
        if (confirm('¿Estás seguro de eliminar esta cama?')) {
            element.closest('form').submit();
        }
    }
</script>
@endsection