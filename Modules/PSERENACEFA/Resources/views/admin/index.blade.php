@extends('pserenacefa::layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index_admin.css') }}"> 

<div class="container mt-4">
    <div class="ambiente-container">
        <h2 class="ambiente-title">
            <center>
            <i class="fas fa-chalkboard-teacher mr-2"></i>Listado de Ambientes
            </center>
        </h2>

        <div class="table-responsive">
            <table class="table table-ambientes">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="15%">Nombre</th>
                        <th width="10%">Capacidad</th>
                        <th width="15%">Ubicación</th>
                        <th width="25%">Descripción</th>
                        <th width="10%">Estado</th>
                        <th width="20%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($environments1 as $index => $ambiente)
                        <tr class="animate-row" style="animation-delay: {{ $index * 0.05 }}s">
                            <td>{{ $ambiente->id }}</td>
                            <td>{{ $ambiente->name }}</td>
                            <td>
                                <i class="fas fa-users text-primary mr-1"></i> 
                                {{ $ambiente->capacity }}
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-primary mr-1"></i> 
                                {{ $ambiente->location }}
                            </td>
                            <td class="description-cell" data-toggle="tooltip" title="{{ $ambiente->description }}">
                                {{ $ambiente->description ?: 'Sin descripción' }}
                            </td>
                            <td>
                                @if($ambiente->status == 'Disponible')
                                    <span class="badge-estado badge-disponible">
                                        <i class="fas fa-check-circle mr-1"></i> Disponible
                                    </span>
                                @else
                                    <span class="badge-estado badge-no-disponible">
                                        <i class="fas fa-times-circle mr-1"></i> No Disponible
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Botón para abrir modal de editar -->
                                    <button class="btn btn-sm btn-primary btn-action btn-edit" data-toggle="modal" data-target="#editModal{{ $ambiente->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                            
                                    <!-- Botón para eliminar con confirmación -->
                                    <form method="POST" action="{{ route('pserenacefa.admin.admin.destroy', $ambiente->id) }}" class="form-eliminar" data-name="{{ $ambiente->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-action btn-delete">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>                                                       
                        </tr>

                        <!-- Modal Editar -->
                        <div class="modal fade modal-custom" id="editModal{{ $ambiente->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $ambiente->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="POST" action="{{ route('pserenacefa.admin.admin.update', $ambiente->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $ambiente->id }}">
                                                <i class="fas fa-edit"></i> Editar Ambiente
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name{{ $ambiente->id }}">
                                                    <i class="fas fa-tag"></i> Nombre
                                                </label>
                                                <input type="text" name="name" id="name{{ $ambiente->id }}" value="{{ $ambiente->name }}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="capacity{{ $ambiente->id }}">
                                                    <i class="fas fa-users"></i> Capacidad
                                                </label>
                                                <input type="number" name="capacity" id="capacity{{ $ambiente->id }}" value="{{ $ambiente->capacity }}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="location{{ $ambiente->id }}">
                                                    <i class="fas fa-map-marker-alt"></i> Ubicación
                                                </label>
                                                <input type="text" name="location" id="location{{ $ambiente->id }}" value="{{ $ambiente->location }}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description{{ $ambiente->id }}">
                                                    <i class="fas fa-align-left"></i> Descripción
                                                </label>
                                                <textarea name="description" id="description{{ $ambiente->id }}" class="form-control" rows="3">{{ $ambiente->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="status{{ $ambiente->id }}">
                                                    <i class="fas fa-toggle-on"></i> Estado
                                                </label>
                                                <select name="status" id="status{{ $ambiente->id }}" class="form-control" required>
                                                    <option value="Disponible" {{ $ambiente->status == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                                    <option value="No Disponible" {{ $ambiente->status == 'No Disponible' ? 'selected' : '' }}>No Disponible</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times mr-1"></i> Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-info">
                                                <i class="fas fa-save mr-1"></i> Guardar Cambios
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-message">
                                <i class="fas fa-info-circle mr-2"></i>No hay ambientes registrados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts necesarios -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Animación para filas de la tabla
        $('.animate-row').each(function(index) {
            $(this).css('animation-delay', (index * 0.05) + 's');
        });

        // Efecto hover para botones
        $('.btn-action').hover(
            function() { $(this).addClass('pulse-animation'); },
            function() { $(this).removeClass('pulse-animation'); }
        );

        // Confirmar eliminación con SweetAlert2
        $('.form-eliminar').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const ambiente = $(this).data('name');

            Swal.fire({
                title: '¿Estás seguro?',
                html: `Vas a eliminar el ambiente <strong>${ambiente}</strong><br><small>Esta acción no se puede deshacer</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3A5A8A',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                backdrop: 'rgba(58, 90, 138, 0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Mostrar mensaje de éxito con SweetAlert2
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Operación exitosa!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3A5A8A',
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    });
</script>

@endsection
