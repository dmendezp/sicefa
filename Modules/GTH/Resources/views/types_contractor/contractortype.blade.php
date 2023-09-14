@extends('gth::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Tipos de Contratos</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                            Crear Tipo de Contrato
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
                                @foreach ($contractortype as $contractor)
                                    <tr>
                                        <td>{{ $contractor->id }}</td>
                                        <td>{{ $contractor->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                data-bs-target="#editarModal" data-id="{{ $contractor->id }}"
                                                data-nombre="{{ $contractor->name }}">Editar</a>
                                                
                                            <form action="{{ route('gth.contractortypes.delete', $contractor->id) }}"
                                                method="POST" class="btnEliminar" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    data-id="{{ $contractor->id }}">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Repite este bloque para cada tipo de contrato -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Tipo de Contrato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gth.contractortypes.create') }}" method="POST" class="btnGuardar">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tipo de Contrato:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <!-- Agrega más campos de formulario según tus necesidades -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success" id="Guardar">Guardar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Contrato:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($contractor))
                        <!-- Cambiado a $contractor -->
                        <form id="editForm" method="POST"
                            action="{{ route('gth.contractortypes.update', ['id' => $contractor->id]) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $contractor->id }}"><!-- Cambiado a $contractor -->
                            <div class="mb-3">
                                <label for="editName" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="editName" name="name"
                                    value="{{ old('name', $contractor->name) }}"> <!-- Cambiado a $contractor -->
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Resto del formulario -->
                            <button type="submit" class="btn btn-primary" onclick="return confirmarCambios()">Guardar
                                Cambios</button>
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

                    console.log('Formulario enviado'); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "¿Estas seguro que deseas eliminar?",
                        text: "Este proceso es irrevesible.",
                        icon: 'Advertencia',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Si, Elimínalo",
                        cancelButtonText: "Cancelar" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    });
                });
            });
    </script>

<script>
    'use strict';
    var Guardar = document.getElementById('Guardar');

    Guardar.addEventListener('click', function() {
        // Simulamos una operación de guardado exitosa (puedes reemplazar esto con tu lógica real de guardado)
        // Supongamos que aquí tienes tu lógica para guardar datos en el servidor

        // Luego de que se haya completado la operación de guardado, muestra el SweetAlert
        Swal.fire({
            title: 'Guardado exitoso',
            text: 'Los datos se han guardado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    });
</script>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editar-btn').click(function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');

                $('#editId').val(id);
                $('#editName').val(nombre);

                // Obtener la ruta de actualización del formulario de edición
                var updateRoute = '{{ route('gth.contractortypes.update', ['id' => ':id']) }}'.replace(
                    ':id', id);

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
