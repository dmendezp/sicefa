@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">Gestión de Tipos de Beneficiarios</h3>
            </div>
            <div class="card-body">
                <h2>Ingresar Nuevo Tipo de Beneficiarios</h2>
                <form id="guardarTipoBeneficio" action="{{ route('typeofbenefits.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Nombre del Tipo de Beneficiarios:</label>
                        <div class="col-md-6">
                            <input type="text" id="name" placeholder="Ingrese Tipo de Beneficiario" name="name" class="form-control" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
                            <span id="name-error" class="text-danger" style="display: none;">Por favor, ingrese un beneficiario.</span>
                            <span id="duplicate-error" class="text-danger" style="display: none;">Este tipo de beneficiario ya está registrado.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success" style="background-color: #00FF22;">Guardar</button>
                        </div>
                    </div>
                </form>
                <div class="mtop16">
                    <h2>Listado de Tipos de Beneficiarios</h2>
                    <table id="typesOfBenefitsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de Beneficiarios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typeofbenefits as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td style="display: flex; justify-content: center;">
                                        <button class="btn btn-primary edit-button" data-id="{{ $type->id }}" data-toggle="modal" data-target="#editModal_{{ $type->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger delete-button" data-id="{{ $type->id }}" data-toggle="modal" data-target="#deleteModal_{{ $type->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($typeofbenefits as $type)
        <!-- Modal de edición -->
        <div class="modal fade" id="editModal_{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{ $type->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel_{{ $type->id }}">Editar Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('typeofbenefits.update', $type->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Usar el método PUT para la actualización -->
                            <div class="form-group row">
                                <label for="edit_name" class="col-md-4 col-form-label text-md-right">Editar Nombre del Tipo de Beneficiarios:</label>
                                <div class="col-md-6">
                                    <input type="text" id="edit_name" name="name" value="{{ $type->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de eliminación -->
        <div class="modal fade" id="deleteModal_{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel_{{ $type->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel_{{ $type->id }}">Confirmar Eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este registro?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('typeofbenefits.destroy', $type->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal de error -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error al Registrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ session('error') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>  

    <script>
        $(document).ready(function() {
            $('#typesOfBenefitsTable').DataTable();

            // Configurar el evento para el formulario de guardar
            $('#guardarTipoBeneficio').submit(function(e) {
                // Validar que el campo de nombre no esté vacío
                var nameInput = $('#name');
                var nameError = $('#name-error');

                if (nameInput.val().trim() === '') {
                    nameError.show();
                    e.preventDefault(); // Evita que se envíe el formulario si hay errores
                } else {
                    nameError.hide();
                }

                e.preventDefault();

                // Realizar la petición AJAX para almacenar el tipo de beneficio
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Actualizar la tabla con los nuevos datos
                        $('#typesOfBenefitsTable tbody').append(response);

                        // Limpiar el campo del formulario
                        $('#name').val('');

                        // Cerrar el modal de error si está abierto
                        $('#errorModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
    if (xhr.status === 422) {
        // Mostrar errores de validación en el formulario
        var errors = JSON.parse(xhr.responseText.errors);
        // Manejar los errores como desees
        console.log(errors);
    } else if (xhr.status === 409) {
        // Mostrar el mensaje de error de duplicación
        $('#duplicate-error').show();
    }
}

            // Evento de clic para el botón de editar
            $('.edit-button').click(function() {
                const id = $(this).data('id');
                $('#editModal_' + id).modal('show');
            });

            // Evento de clic para el botón de eliminar
            $('.delete-button').click(function() {
                const id = $(this).data('id');
                $('#deleteModal_' + id).modal('show');
            });
        });
    </script>
</div>
@endsection
