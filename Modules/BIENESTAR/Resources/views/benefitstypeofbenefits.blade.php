@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <h1>Gestión de Tipos de Beneficios</h1>
</div>

<div class="container">
    <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
        <!-- Primera Grilla: Tabla con Datos Existentes -->
        <div class="row">
            <div class="col-md-6">
                <h2>Listado de Tipos de Beneficios</h2>
                <table id="typesOfBenefitsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo de Beneficio</th>
                            <th>Tipo de Beneficiario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($benefitstypeofbenefits as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->benefit->name }}</td>
                            <td>{{ $type->typeOfBenefit->name }}</td>
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
        
            <!-- Segunda Grilla: Formulario para Agregar Nuevo Tipo de Beneficio -->
<div class="col-md-6">
    <br>
    <br>
    <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
        <h2>Ingresar Nuevo Tipo de Beneficio</h2>
        <form id="guardarTipoBeneficio" action="{{ route('bienestar.benefitstypeofbenefits.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="benefit_id">Seleccionar Tipo de Beneficio:</label>
                <select id="benefit_id" name="benefit_id" class="form-control">
                    @foreach($benefits as $benefit)
                        <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="type_of_benefit_id">Seleccionar Tipo de Beneficiario:</label>
                <select id="type_of_benefit_id" name="type_of_benefit_id" class="form-control">
                    @foreach($typeofbenefits as $typeofbenefit)
                        <option value="{{ $typeofbenefit->id }}">{{ $typeofbenefit->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="botton_guardar" style="background-color: #00FF22; color: white;">Guardar</button>
        </form>
    </div>
</div>

        </div>
    </div>
</div>

@foreach($benefitstypeofbenefits as $type)
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
                    <form action="{{ route('bienestar.benefitstypeofbenefits.update', $type->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_benefit">Editar Tipo de Beneficio:</label>
                            <select id="edit_benefit" name="benefit_id" class="form-control">
                                @foreach($benefits as $benefit)
                                    <option value="{{ $benefit->id }}" {{ $type->benefit_id == $benefit->id ? 'selected' : '' }}>{{ $benefit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_type">Editar Tipo de Beneficiario:</label>
                            <select id="edit_type" name="type_of_benefit_id" class="form-control">
                                @foreach($typeofbenefits as $typeofbenefit)
                                    <option value="{{ $typeofbenefit->id }}" {{ $type->type_of_benefit_id == $typeofbenefit->id ? 'selected' : '' }}>{{ $typeofbenefit->name }}</option>
                                @endforeach
                            </select>
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
                    <form action="{{ route('benefitstypeofbenefits.destroy', $type->id) }}" method="POST" style="display: inline;">
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
