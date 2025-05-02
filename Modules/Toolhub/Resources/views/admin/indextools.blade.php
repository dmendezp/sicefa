@extends('toolhub::layouts.master')

@section('content')
<style>
/* Estilos personalizados para el sistema de gestión de herramientas */
.bg-success {
  background-color: #0f5132 !important;
}

.btn-success {
  background-color: #0f5132;
  border-color: #0f5132;
}

.btn-success:hover {
  background-color: #0c4128;
  border-color: #0c4128;
}

.bg-purple {
  background-color: #6f42c1 !important;
}

.text-purple {
  color: #6f42c1 !important;
}

.table th {
  font-weight: 500;
  color: #495057;
}

.badge {
  font-weight: 500;
}

.card {
  border-radius: 0.5rem;
  border: 1px solid rgba(0, 0, 0, 0.08);
}

.card-header {
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 0, 0, 0.02);
}
</style>

<div class="container-fluid p-0">
    <!-- Header -->
    <div class="bg-success text-white p-4 mb-4">
        <h2 class="mb-0">Sistema de Gestión de Herramientas</h2>
        <p class="mb-0">SENA - Control de Inventario</p>
    </div>

    <!-- Toolbar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#createToolModal">
                <i class="fas fa-plus me-1"></i> Nueva Herramienta
            </button>
            <button class="btn btn-outline-secondary">
                <i class="fas fa-filter me-1"></i> Filtrar
            </button>
        </div>
        <div class="d-flex align-items-center">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Buscar por nombre o código...">
            </div>
            <button class="btn btn-outline-secondary ms-2">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Inventario de Herramientas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Código <i class="fas fa-sort ms-1"></i></th>
                            <th>Nombre <i class="fas fa-sort ms-1"></i></th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Cantidad</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tools as $tool)
                        <tr>
                            <td class="ps-4">{{ $tool->code }}</td>
                            <td>{{ $tool->name }}</td>
                            <td>
                                @php
                                    $categoryClass = 'bg-info bg-opacity-10 text-info';
                                    if ($tool->category == 'Electrica') {
                                        $categoryClass = 'bg-warning bg-opacity-10 text-warning';
                                    } elseif ($tool->category == 'Mecanica') {
                                        $categoryClass = 'bg-primary bg-opacity-10 text-primary';
                                    } elseif ($tool->category == 'Neumatica') {
                                        $categoryClass = 'bg-purple bg-opacity-10 text-purple';
                                    }
                                @endphp
                                <span class="badge rounded-pill {{ $categoryClass }} px-3 py-2">{{ $tool->category }}</span>
                            </td>
                            <td>
                                @php
                                    $conditionClass = $tool->condition == 'new' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning';
                                    $conditionText = $tool->condition == 'new' ? 'Nueva' : 'Usada';
                                @endphp
                                <span class="badge rounded-pill {{ $conditionClass }} px-3 py-2">{{ $conditionText }}</span>
                            </td>
                            <td>{{ $tool->quantity ?? 1 }}</td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-primary edit-button me-1"
                                    data-id="{{ $tool->id }}"
                                    data-code="{{ $tool->code }}"
                                    data-name="{{ $tool->name }}"
                                    data-description="{{ $tool->description }}"
                                    data-condition="{{ $tool->condition }}"
                                    data-category="{{ $tool->category }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editToolModal">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(event, 'delete-form-{{ $tool->id }}')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                                <form id="delete-form-{{ $tool->id }}" action="{{ route('toolhub.admin.admin.destroy', $tool->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- Modal CREAR -->
<div class="modal fade" id="createToolModal" tabindex="-1" aria-labelledby="createToolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('toolhub.admin.admin.store')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createToolModalLabel">Registrar Herramienta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-control" name="condition" required>
                            <option value="new">Nuevo</option>
                            <option value="used">Usado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select class="form-control" name="category" required>
                            <option value="Manual">Manual</option>
                            <option value="Electrica">Eléctrica</option>
                            <option value="Mecanica">Mecánica</option>
                            <option value="Neumatica">Neumática</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="quantity" value="1" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal EDITAR -->
<div class="modal fade" id="editToolModal" tabindex="-1" aria-labelledby="editToolModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editToolForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editToolModalLabel">Editar Herramienta</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editToolId">
          <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" name="code" id="editCode" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" id="editName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" id="editDescription" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="condition" id="editCondition" class="form-control" required>
              <option value="new">Nuevo</option>
              <option value="used">Usado</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category" id="editCategory" class="form-control" required>
              <option value="Manual">Manual</option>
              <option value="Electrica">Eléctrica</option>
              <option value="Mecanica">Mecánica</option>
              <option value="Neumatica">Neumática</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input type="number" name="quantity" id="editQuantity" class="form-control" value="1" min="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        if (confirm('¿Estás seguro de que deseas eliminar esta herramienta?')) {
            document.getElementById(formId).submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-button');
        const form = document.getElementById('editToolForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const code = button.getAttribute('data-code');
                const name = button.getAttribute('data-name');
                const description = button.getAttribute('data-description');
                const condition = button.getAttribute('data-condition');
                const category = button.getAttribute('data-category');
                const quantity = button.getAttribute('data-quantity') || '1';

                document.getElementById('editCode').value = code;
                document.getElementById('editName').value = name;
                document.getElementById('editDescription').value = description;
                document.getElementById('editCondition').value = condition;
                document.getElementById('editCategory').value = category;
                document.getElementById('editQuantity').value = quantity;

                form.action = `/admin/admin/indextools/${id}`; // Ajusta si usas otra ruta
            });
        });
    });
</script>
@endsection
