@foreach ($employees as $employee)
    <div class="modal fade" id="editarModal_{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModolLabel">Editar Funcionario {{ $employee->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($employee))
                        <!--Cambio a $employee-->
                        <form id="editForm" method="POST"
                            action="{{ route('cefa.gth.officials.update', ['id' => $employee->id]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id"
                                value="{{ $employee->id }}"><!-- Cambiado a $contract -->

                            <!-- Número de documento -->
                            <div class="form-group">
                                <label for="document_number-{{$employee->id }}" class="form-label">Número de Documento</label>
                                <input type="number" name="document_number" id="document_number-{{$employee->id }}"
                                    class="form-control" value="{{old('document_number', $employee->person->document_number) }}" required>
                            </div>


                            <div class="form-group">
                                <label for="full_name-{{$employee->id }}" class="form-label">Nombre</label>
                                <input type="text" name="full_name_edit" id="full_name_edit-{{$employee->id }}" class="form-control"
                                    value="{{old('full_name_edit', $employee->person->full_name) }}" readonly>
                            </div>

                            <!-- Otros campos de entrada -->
                            <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_number-{{$employee->id }}" class="form-label">Número de contrato</label>
                                        <input type="text" class="form-control" id="contract_number-{{$employee->id }}"
                                            name="contract_number" value="{{ old('contract_number', $employee->contract_number) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_date-{{$employee->id }}"class="form-label">Fecha de contrato</label>
                                        <input type="date" class="form-control" id="contract_date-{{$employee->id }}"
                                            name="contract_date" value="{{ old('contract_date', $employee->contract_date) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="professional_card_number-{{$employee->id }}"class="form-label">Número de tarjeta profesional</label>
                                        <input type="text" class="form-control" id="professional_card_number-{{$employee->id }}"
                                            name="professional_card_number" value="{{ old('professional_card_number', $employee->professional_card_number) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="professional_card_issue_date-{{$employee->id }}"class="form-label">Fecha de emisión de la tarjeta profesional</label>
                                        <input type="date" class="form-control" id="professional_card_issue_date-{{$employee->id }}"
                                            name="professional_card_issue_date" value="{{ old('professional_card_issue_date', $employee->contract_date) }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="employee_type_id-{{$employee->id }}"class="form-label">Tipo de empleado</label>
                                            <select name="employee_type_id" id="employee_type_id_edit"
                                            class="form-control @error('employee_type_id') is-invalid @enderror"
                                            required>
                                                <option value="">Seleccione tipo de empleado</option>
                                                @foreach ($employeeTypes as $employeeType)
                                                    <option value="{{ $employeeType->id }}"
                                                        {{ $employeeType->id == $employee->employee_type_id ? 'selected' : '' }}>
                                                        {{ $employeeType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="position_id-{{$employee->id }}"class="form-label">Cargo</label>
                                            <select name="position_id" id="position_id" class="form-control @error('position_id') is-invalid @enderror"
                                            required>
                                                <option value="">Seleccione cargo</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ $position->id == $employee->position_id ? 'selected' : '' }}>
                                                        {{ $position->id }}-{{ $position->professional_denomination }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="risk_type">Tipo de riesgo</label>
                                            <select name="risk_type" id="risk_type" class="form-control @error('risk_type') is-invalid @enderror" required>
                                                <option value="">Seleccione tipo de riesgo</option>
                                                <option value="I"
                                                    {{ old('risk_type', $employee->risk_type) == 'I' ? 'selected' : '' }}>I
                                                </option>
                                                <option value="II"
                                                    {{ old('risk_type', $employee->risk_type) == 'II' ? 'selected' : '' }}>II
                                                </option>
                                                <option value="III"
                                                    {{ old('risk_type', $employee->risk_type) == 'III' ? 'selected' : '' }}>III
                                                </option>
                                                <option value="IV"
                                                    {{ old('risk_type', $employee->risk_type) == 'IV' ? 'selected' : '' }}>IV
                                                </option>
                                                <option value="V"
                                                    {{ old('risk_type', $employee->risk_type) == 'V' ? 'selected' : '' }}>V
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="state">Estado</label>
                                            <select name="state" id="state_edit" class="form-control @error('state') is-invalid @enderror">
                                                <option value="activo"
                                                    {{ old('state', $employee->state) === 'activo' ? 'selected' : '' }}>
                                                    Activo
                                                </option>
                                                <option value="inactivo"
                                                    {{ old('state', $employe->state) === 'inactivo' ? 'selected' : '' }}>
                                                    Inactivo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                        <button type="submit" class="btn btn-primary" onclick="return confirmarCambios()">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
<script>
   
    // Rellenar el formulario de edición con los datos del empleado cuando se muestra el modal
    $('.open-edit-modal').on('click', function confirmarCambios() ) {
        var employeeId = $(this).data('employee-id');
        var modal = $('#editarModal' + employeeId);
        // Rellenar previamente el formulario de edición con los datos del empleado

        var employee = {!! $employees->toJson() !!}.find(e => e.id === employeeId);

        modal.find('#document_number_edit').val(employee.person.document_number);
        modal.find('#full_name_edit').val(employee.person.full_name);
        modal.find('#contract_number_edit').val(employee.contract_number);
        modal.find('#contract_date').val(employee.contract_date);
        modal.find('#professional_card_number').val(employee.professional_card_number);
        modal.find('#professional_card_issue_date').val(employee.professional_card_issue_date);
        modal.find('#employee_type_id_edit').val(employee.employee_type_id);
        modal.find('#position_id_edit').val(employee.position_id);
        modal.find('#risk_type_edit').val(employee.risk_type);
        modal.find('#state_edit').val(employee.state);

        modal.modal('show');
    });
</script>
