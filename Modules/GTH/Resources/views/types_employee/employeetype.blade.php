@extends('gth::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Tipos de Empleado</h1>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                        Crear Tipo de Empleado
                    </button>
                        <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeetype as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="{{ $employee->id }}" data-nombre="{{ $employee->name }}">Editar</a>
                                    <form action="{{ route('gth.employeetypes.delete', $employee->id) }}" method="POST" id="btnEliminar" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class="btn btn-danger" data-id="{{ $employee->id }}">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <!-- Repite este bloque para cada tipo de empleado -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Creación -->
<div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Tipo de Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gth.employeetypes.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tipo de Empleado:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <!-- Agrega más campos de formulario según tus necesidades -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(isset($employee)) <!-- Cambiado a $employee -->
                <form id="editForm" method="POST" action="{{ route('gth.employeetypes.update', ['id' => $employee->id]) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $employee->id }}"> <!-- Cambiado a $employee -->
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{ old('name', $employee->name) }}"> <!-- Cambiado a $employee -->
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Resto del formulario -->
                    <button type="submit" class="btn btn-primary" onclick="return confirmarCambios()">Guardar Cambios</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    'use strict';
    // Selecciona todos los formularios con la clase "formEliminar"
    var forms = document.querySelectorAll('.btnEliminar');

    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita que el formulario se envíe de inmediato

                Swal.fire({
                    title: "Are you sure?'",
                    text: "It is an irreversible process.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, delete it'",
                    cancelButtonText: "Cancel" // Cambiar el texto del botón "Cancelar"
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    }
                });
            });
        });

</script>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.editar-btn').click(function() {
            var id = $(this).data('id');
            var nombre = $(this).data('nombre');

            $('#editId').val(id);
            $('#editName').val(nombre);

            // Obtener la ruta de actualización del formulario de edición
            var updateRoute = '{{ route("gth.employeetypes.update", ["id" => ":id"]) }}'.replace(':id', id);

            // Asignar la ruta de actualización al formulario de edición
            $('#editForm').attr('action', updateRoute);
        });

        $('#editForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'), // Usar la ruta de acción del formulario
                method: 'PATCH',
                data: formData,
                success: function(response) {
                    // Actualizar la página después de un breve retraso
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // Espera 1 segundo (1000 milisegundos) antes de recargar

                    // Cerrar el modal
                    var modal = new bootstrap.Modal(document.getElementById('editarModal'));
                    modal.hide();
                }
            });
        });
    });
</script>


@endpush