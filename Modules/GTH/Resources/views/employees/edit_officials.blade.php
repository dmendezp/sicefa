<div class="modal fade" id="editarModal{{ $employe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Funcionario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cefa.gth.officials.update', ['id' => $employe->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Document Number -->
                    <div class="form-group">
                        <label for="document_number">Número de Documento</label>
                        <input type="number" name="document_number" id="document_number_edit" class="form-control" value="{{ $employe->person->document_number }}" required>
                    </div>

                    <!-- Full Name (Read-only) -->
                    <div class="form-group">
                        <label for="full_name">Nombre</label>
                        <input type="text" name="full_name" id="full_name_edit" class="form-control" value="{{ $employe->person->full_name }}" readonly>
                    </div>

                    <!-- Other Input Fields -->
                    <div class="form-group">
                        <label for="contract_number">Número de contrato</label>
                        <input type="text" class="form-control" id="contract_number_edit" name="contract_number" value="{{ $employe->contract_number }}" placeholder="Ingrese el número de contrato">
                    </div>

                    <div class="form-group">
                        <label for="contract_date">Fecha de contrato</label>
                        <input type="date" class="form-control" id="contract_date" name="contract_date" value="{{ $employe->contract_date }}"
                            placeholder="Ingrese la fecha de contrato">
                    </div>
                    <div class="form-group">
                        <label for="professional_card_number">Número de tarjeta profesional</label>
                        <input type="text" class="form-control" id="professional_card_number"
                            name="professional_card_number" value="{{ $employe->contract_date }}" placeholder="Ingrese el número de tarjeta profesional">
                    </div>
                    <div class="form-group">
                        <label for="professional_card_issue_date">Fecha de emisión de la tarjeta
                            profesional</label>
                        <input type="date" class="form-control" id="professional_card_issue_date"
                            name="professional_card_issue_date" value="{{ $employe->contract_date }}"
                            placeholder="Ingrese la fecha de emisión de la tarjeta profesional">
                    </div>

                    <div class="form-group">
                        <label for="employee_type_id">Tipo de empleado</label>
                        <select class="form-control" id="employee_type_id_edit" name="employee_type_id">
                            <option value="">Seleccione tipo de empleado</option>
                            @foreach ($employeeTypes as $employeeType)
                                <option value="{{ $employeeType->id }}" {{ $employeeType->id == $employe->employee_type_id ? 'selected' : '' }}>
                                    {{ $employeeType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="position_id">Cargo</label>
                        <select class="form-control" id="position_id_edit" name="position_id">
                            <option value="">Seleccione cargo</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" {{ $position->id == $employe->position_id ? 'selected' : '' }}>
                                    {{ $position->id }}-{{ $position->professional_denomination }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="risk_type">Tipo de riesgo</label>
                        <select class="form-control" id="risk_type_edit" name="risk_type">
                            <option value="">Seleccione tipo de riesgo</option>
                            <option value="I" {{ $employe->risk_type == 'I' ? 'selected' : '' }}>I</option>
                            <option value="II" {{ $employe->risk_type == 'II' ? 'selected' : '' }}>II</option>
                            <option value="III" {{ $employe->risk_type == 'III' ? 'selected' : '' }}>III</option>
                            <option value="IV" {{ $employe->risk_type == 'IV' ? 'selected' : '' }}>IV</option>
                            <option value="V" {{ $employe->risk_type == 'V' ? 'selected' : '' }}>V</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="state">Estado</label>
                        <select class="form-control" id="state_edit" name="state">
                            <option value="activo" {{ $employe->state == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $employe->state == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Populate the edit form with employee data when the modal is shown
    $('.open-edit-modal').on('click', function () {
        var employeeId = $(this).data('employee-id');
        var modal = $('#editarModal' + employeeId);
        // Pre-fill the edit form with employee data
        modal.find('#document_number_edit').val('{{ $employe->person->document_number }}');
        modal.find('#full_name_edit').val('{{ $employe->person->full_name }}');
        modal.find('#contract_number_edit').val('{{ $employe->contract_number }}');
        modal.find('#contract_date').val('{{ $employe->contract_date }}');
        modal.find('#professional_card_number').val('{{ $employe->professional_card_number }}');
        modal.find('#professional_card_issue_date').val('{{ $employe->professional_card_issue_date }}');
        modal.find('#employee_type_id_edit').val('{{ $employe->employee_type_id }}');
        modal.find('#position_id_edit').val('{{ $employe->position_id }}');
        modal.find('#risk_type_edit').val('{{ $employe->risk_type }}');
        modal.find('#state_edit').val('{{ $employe->state }}');

        modal.modal('show');
    });
</script>

