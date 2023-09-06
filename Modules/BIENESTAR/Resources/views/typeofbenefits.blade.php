@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-6">
            <div class="card-header">
                <h3 class="card-title">Gestión de Tipos de Beneficiarios</h3>
            </div>
            <div class="card-body">
                <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
                    <h2>Ingresar Nuevo Tipo de Beneficiarios</h2>
                    <form id="guardarTipoBeneficio" action="{{ route('typeofbenefits.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nombre del Tipo de Beneficiarios:</label>
                            <input type="text" id="name" placeholder="Ingrese Tipo de Beneficiario" name="name" style="border-radius: 10px; padding: 5px; width: 100%;" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" required>
                            <span id="name-error" class="error-message" style="color: red; display: none;">Por favor, ingrese un beneficiario.</span>
                        </div>
                        <button type="submit" class="botton_guardar" style="background-color: #00FF22; color: white;">Guardar</button>
                    </form>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
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
                                            <button class="edit-button" data-id="{{ $type->id }}" data-toggle="modal" data-target="#editModal_{{ $type->id }}" style="background-color: #00DCFF; border-radius: 10px; padding: 5px; width: 30px; height: 30px; margin-right: 5px; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-cog" style="color: #000000;"></i>
                                            </button>
                                            <button class="delete-button" data-id="{{ $type->id }}" data-toggle="modal" data-target="#deleteModal_{{ $type->id }}" style="background-color: #FF001A; border-radius: 10px; padding: 5px; width: 30px; height: 30px; margin-left: 5px; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-trash" style="color: #000000;"></i>
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
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_name">Editar Nombre del Tipo de Beneficiarios:</label>
                                <input type="text" id="edit_name" name="name" value="{{ $type->name }}" style="border-radius: 10px; padding: 5px; width: 100%;">
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
    
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
    
<!-- Tu script jQuery y otros elementos JavaScript aquí -->
@endsection
