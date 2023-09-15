<!-- Modal de Edición -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Contrato: {{$contract->id}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (isset($contract))
                    <!-- Cambiado a $contract -->
                    <form id="editForm" method="POST" action="{{ route('gth.contractor.update', ['id' => $contract->id]) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $contract->id }}"><!-- Cambiado a $contract -->
                        <div class="mb-3">
                            <label for="contract_number-{{ $contract->id }}"
                                class="form-label">Número de Contrato:</label>
                            <input type="text" class="form-control"
                                id="contract_number-{{ $contract->id }}"
                                name="contract_number"
                                value="{{ old('contract_number', $contract->contract_number) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_year-{{ $contract->id }}"
                                class="form-label">Año de Contrato:</label>
                            <input type="text" class="form-control"
                                id="contract_year-{{ $contract->id }}"
                                name="contract_year"
                                value="{{ old('contract_year', $contract->contract_year) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_start_date-{{ $contract->id }}"
                                class="form-label">Fecha de Inicio de Contrato:</label>
                            <input type="date" class="form-control"
                                id="contract_start_date-{{ $contract->id }}"
                                name="contract_start_date"
                                value="{{ old('contract_start_date', $contract->contract_start_date) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_end_date-{{ $contract->id }}"
                                class="form-label">Fecha de Fin de Contrato:</label>
                            <input type="date" class="form-control"
                                id="contract_end_date-{{ $contract->id }}"
                                name="contract_end_date"
                                value="{{ old('contract_end_date', $contract->contract_end_date) }}"
                                required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contractor_type_id-{{ $contract->id }}"
                                class="form-label">Tipo de Contrato:</label>
                            <input type="text" class="form-control"
                            id="contractor_type_id-{{ $contract->id }}"
                            name="contractor_type_id"
                            value="{{ old('contractor_type_id', $contract->contractor_type_id) }}"
                            required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_type_id-{{ $contract->id }}"
                                class="form-label">Tipo de Empleado:</label>
                                <input type="text" class="form-control"
                                id="employee_type_id-{{ $contract->id }}"
                                name="employee_type_id"
                                value="{{ old('employee_type_id', $contract->employee_type_id) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="amount_hours-{{ $contract->id }}"
                                class="form-label">Horas de Trabajo:</label>
                            <input type="text" class="form-control"
                                id="amount_hours-{{ $contract->id }}"
                                name="amount_hours"
                                value="{{ old('amount_hours', $contract->amount_hours) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="total_contract_value-{{ $contract->id }}"
                                class="form-label">Valor Total del Contrato:</label>
                            <input type="text" class="form-control"
                                id="total_contract_value-{{ $contract->id }}"
                                name="total_contract_value"
                                value="{{ old('total_contract_value', $contract->total_contract_value) }}"
                                required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="sesion-{{ $contract->id }}"
                                class="form-label">Sesión:</label>
                            <input type="text" class="form-control"
                                id="sesion-{{ $contract->id }}" name="sesion"
                                value="{{ old('sesion', $contract->sesion) }}">
                        </div>
                        <div class="mb-3">
                            <label for="sesion_date-{{ $contract->id }}"
                                class="form-label">Fecha de Sesión:</label>
                            <input type="date" class="form-control"
                                id="sesion_date-{{ $contract->id }}" name="sesion_date"
                                value="{{ old('sesion_date', $contract->sesion_date) }}">
                        </div>
                        <div class="mb-3">
                            <label for="SIIF_code-{{ $contract->id }}"
                                class="form-label">Código SIIF:</label>
                            <input type="text" class="form-control"
                                id="SIIF_code-{{ $contract->id }}" name="SIIF_code"
                                value="{{ old('SIIF_code', $contract->SIIF_code) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="assigment_value-{{ $contract->id }}"
                                class="form-label">Valor de Asignacion:</label>
                            <input type="text" class="form-control"
                                id="assigment_valuee-{{ $contract->id }}"
                                name="assigment_value"
                                value="{{ old('assigment_value', $contract->assigment_value) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="insurer_entity_id-{{ $contract->id }}"
                                class="form-label">Entidad Aseguradora:</label>
                            <input type="text" class="form-control"
                                id="insurer_entity_id-{{ $contract->id }}"
                                name="insurer_entity_id"
                                value="{{ old('insurer_entity_id', $contract->insurer_entity_id) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="policy_number-{{ $contract->id }}"
                                class="form-label">Número de Póliza:</label>
                            <input type="text" class="form-control"
                                id="policy_number-{{ $contract->id }}"
                                name="policy_number"
                                value="{{ old('policy_number', $contract->policy_number) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="policy_issue_date-{{ $contract->id }}"
                                class="form-label">Fecha de Emisión de la Póliza:</label>
                            <input type="date" class="form-control"
                                id="policy_issue_date-{{ $contract->id }}"
                                name="policy_issue_date"
                                value="{{ old('policy_issue_date', $contract->policy_issue_date) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="policy_approval_date-{{ $contract->id }}"
                                class="form-label">Fecha de Aprobación de la
                                Póliza:</label>
                            <input type="date" class="form-control"
                                id="policy_approval_date-{{ $contract->id }}"
                                name="policy_approval_date"
                                value="{{ old('policy_approval_date', $contract->policy_approval_date) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="policy_effective_date-{{ $contract->id }}"
                                class="form-label">Fecha de Vigencia de la Póliza:</label>
                            <input type="date" class="form-control"
                                id="policy_effective_date-{{ $contract->id }}"
                                name="policy_effective_date"
                                value="{{ old('policy_effective_date', $contract->policy_effective_date) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="policy_expiration_date-{{ $contract->id }}"
                                class="form-label">Fecha de Vencimiento de la
                                Póliza:</label>
                            <input type="date" class="form-control"
                                id="policy_expiration_date-{{ $contract->id }}"
                                name="policy_expiration_date"
                                value="{{ old('policy_expiration_date', $contract->policy_expiration_date) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="risk_type-{{ $contract->id }}"
                                class="form-label">Tipo de Riesgo:</label>
                            <input type="text" class="form-control"
                                id="risk_type-{{ $contract->id }}" name="risk_type"
                                value="{{ old('risk_type', $contract->risk_type) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="state-{{ $contract->id }}"
                                class="form-label">Estado:</label>
                            <input type="text" class="form-control"
                                id="state-{{ $contract->id }}" name="state"
                                value="{{ old('state', $contract->state) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_object-{{ $contract->id }}"
                                class="form-label">Objeto del Contrato:</label>
                            <input type="text" class="form-control"
                                id="contract_object-{{ $contract->id }}"
                                name="contract_object"
                                value="{{ old('contract_object', $contract->contract_object) }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_obligations-{{ $contract->id }}"
                                class="form-label">Obligacion del Contrato:</label>
                            <input type="text" class="form-control"
                                id="contract_obligations-{{ $contract->id }}"
                                name="contract_obligations"
                                value="{{ old('contract_obligations', $contract->contract_obligations) }}"
                                required>
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