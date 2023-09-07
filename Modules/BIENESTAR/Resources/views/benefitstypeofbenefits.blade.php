@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ __('Gestión de Tipos de Beneficios') }}</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'bienestar.benefitstypeofbenefits.store', 'method' => 'POST', 'role' => 'form', 'id' => 'guardarTipoBeneficio']) !!}
                <div class="row p-3">
                    <div class="col-md-4">
                        {!! Form::label('benefit_id', 'Seleccionar Tipo de Beneficio:') !!}
                        <select id="benefit_id" name="benefit_id" class="form-control" required>
                            @foreach($benefits as $benefit)
                                <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('type_of_benefit_id', 'Seleccionar Tipo de Beneficiario:') !!}
                        <select id="type_of_benefit_id" name="type_of_benefit_id" class="form-control" required>
                            @foreach($typeofbenefits as $typeofbenefit)
                                <option value="{{ $typeofbenefit->id }}">{{ $typeofbenefit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 align-self-end">
                        <div class="btns mt-3">
                            {!! Form::submit('Guardar',['class'=>'btn btn-success', 'style'=>'background-color: #00FF22; color: black;']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <!-- Error si el campo de beneficio es obligatorio -->
                <div class="text-danger" id="benefit-error" style="display: none;">
                    El campo "Seleccionar Tipo de Beneficio" es obligatorio.
                </div>
                <!-- Error si el campo de tipo de beneficiario es obligatorio -->
                <div class="text-danger" id="type_of_benefit-error" style="display: none;">
                    El campo "Seleccionar Tipo de Beneficiario" es obligatorio.
                </div>

                <div class="mtop16">
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
                                <td>{{ $type->benefits->name }}</td>
                                <td>{{ $type->typeOfBenefits->name }}</td>
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
                            <div class="form-group row">
                                <label for="edit_benefit" class="col-md-4 col-form-label text-md-right">Editar Tipo de Beneficio:</label>
                                <div class="col-md-6">
                                    <select id="edit_benefit" name="benefit_id" class="form-control" required>
                                        @foreach($benefits as $benefit)
                                            <option value="{{ $benefit->id }}" {{ $type->benefit_id == $benefit->id ? 'selected' : '' }}>{{ $benefit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="edit_type" class="col-md-4 col-form-label text-md-right">Editar Tipo de Beneficiario:</label>
                                <div class="col-md-6">
                                    <select id="edit_type" name="type_of_benefit_id" class="form-control" required>
                                        @foreach($typeofbenefits as $typeofbenefit)
                                            <option value="{{ $typeofbenefit->id }}" {{ $type->type_of_benefit_id == $typeofbenefit->id ? 'selected' : '' }}>{{ $typeofbenefit->name }}</option>
                                        @endforeach
                                    </select>
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
</div>

<script>
    $(document).ready(function() {
        $('#typesOfBenefitsTable').DataTable();

        // Configurar el evento para el formulario de guardar
        $('#guardarTipoBeneficio').submit(function(e) {
            // Validar que el campo de beneficio y tipo de beneficiario no estén vacíos
            var benefitSelect = $('#benefit_id');
            var typeOfBeneficiarySelect = $('#type_of_benefit_id');
            var benefitError = $('#benefit-error');
            var typeOfBeneficiaryError = $('#type_of_benefit-error');

            if (benefitSelect.val() === '') {
                benefitError.show();
                e.preventDefault();
            } else {
                benefitError.hide();
            }

            if (typeOfBeneficiarySelect.val() === '') {
                typeOfBeneficiaryError.show();
                e.preventDefault();
            } else {
                typeOfBeneficiaryError.hide();
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
                    
                    // Limpiar los campos del formulario
                    $('#benefit_id').val('');
                    $('#type_of_benefit_id').val('');
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

@endsection

