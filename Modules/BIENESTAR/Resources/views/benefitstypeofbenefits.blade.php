@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-8">
            <div class="card-header">
                <h3 class="card-title">{{ trans('bienestar::menu.Configure Benefits') }}</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'cefa.bienestar.benefitstypeofbenefits.store', 'role' => 'form', 'class' => 'formCrear']) !!}
                @csrf
                <div class="row p-3">
                    <div class="col-md-4">
                        {!! Form::label('benefit_id', trans('bienestar::menu.Select Benefit Type')) !!}
                        <select id="benefit_id" name="benefit_id" class="form-control" required>
                            @foreach($benefits as $benefit)
                                <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        {!! Form::label('type_of_benefit_id', trans('bienestar::menu.Select Beneficiary Type')) !!}
                        <select id="type_of_benefit_id" name="type_of_benefit_id" class="form-control" required>
                            @foreach($typeOfBenefits as $typeOfBenefit)
                                <option value="{{ $typeOfBenefit->id }}">{{ $typeOfBenefit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 align-self-end">
                        <div class="btns mt-3">
                            {!! Form::submit(trans('bienestar::menu.Save')  , ['class' => 'btn btn-success formSubmitButton', 'style' => 'background-color: #00FF22; color: black;']) !!}
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
                                <th>{{ trans('bienestar::menu.Benefit Type') }}</th>
                                <th>{{ trans('bienestar::menu.Beneficiary Type') }}</th>
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
                                    <button class="btn btn-primary edit-button formSubmitButton" data-id="{{ $type->id }}" data-toggle="modal" data-target="#editModal_{{ $type->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('cefa.bienestar.benefitstypeofbenefits.destroy', $type->id) }}" method="POST" class="formEliminar">
                                        @csrf
                                        @method("DELETE")
                                        <!-- Botón para abrir el modal de eliminación -->
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
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
                <h5 class="modal-title">{{ trans('bienestar::menu.Edit Record') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cefa.bienestar.benefitstypeofbenefits.update', $type->id) }}" method="POST" class="formEditar">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_benefit">{{ trans('bienestar::menu.Edit Benefit Type Name') }}:</label>
                        <select id="edit_benefit" name="benefit_id" class="form-control" required>
                            @foreach($benefits as $benefit)
                                <option value="{{ $benefit->id }}" {{ $type->benefit_id == $benefit->id ? 'selected' : '' }}>{{ $benefit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_type">{{ trans('bienestar::menu.Edit Beneficiary Type Name') }}:</label>
                        <select id="edit_type" name="type_of_benefit_id" class="form-control" required>
                            @foreach($typeOfBenefits as $typeofbenefit)
                                <option value="{{ $typeofbenefit->id }}" {{ $type->type_of_benefit_id == $typeofbenefit->id ? 'selected' : '' }}>{{ $typeofbenefit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">{{ trans('bienestar::menu.Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('bienestar::menu.Save Changes') }}</button>
                    </div>
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
            e.preventDefault();

            // Deshabilita el botón de guardar para evitar clics múltiples
            $('.formSubmitButton').prop('disabled', true);

            // Validar que el campo de beneficio y tipo de beneficiario no estén vacíos
            var benefitSelect = $('#benefit_id');
            var typeOfBeneficiarySelect = $('#type_of_benefit_id');
            var benefitError = $('#benefit-error');
            var typeOfBeneficiaryError = $('#type_of_benefit-error');

            if (benefitSelect.val() === '') {
                benefitError.show();
            } else {
                benefitError.hide();
            }

            if (typeOfBeneficiarySelect.val() === '') {
                typeOfBeneficiaryError.show();
            } else {
                typeOfBeneficiaryError.hide();
            }

            // Verificar si hay errores de validación antes de realizar la petición AJAX
            if (benefitError.is(':visible') || typeOfBeneficiaryError.is(':visible')) {
                // Habilitar el botón de guardar nuevamente
                $('.formSubmitButton').prop('disabled', false);
                return; // Detener el envío si hay errores de validación
            }

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

                    // Habilitar el botón de guardar nuevamente
                    $('.formSubmitButton').prop('disabled', false);
                },
                error: function(error) {
                    console.log(error);

                    // Habilitar el botón de guardar nuevamente en caso de error
                    $('.formSubmitButton').prop('disabled', false);
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
