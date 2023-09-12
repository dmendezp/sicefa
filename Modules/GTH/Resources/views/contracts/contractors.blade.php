@extends('gth::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Reporte de Contratos</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                            Crear Contrato
                        </button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de Documento</th>
                                    <th>Número de Documento</th>
                                    <th>Nombre Completo</th>
                                    <!-- Agrega más encabezados según tus necesidades -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractors as $contract)
                                    <tr>
                                        <td>{{ $contract->id }}</td>
                                        <td>{{ $contract->person->document_type }}</td>
                                        <td>{{ $contract->person->document_number }}</td>
                                        <td>{{ $contract->person->first_name }} {{ $contract->person->first_last_name }}
                                            {{ $contract->person->second_last_name }}</td>
                                        <!-- Agrega más campos según tus necesidades -->
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editarModal" data-id="{{ $contract->id }}"
                                                    data-contract-number="{{ $contract->contract_number }}"
                                                    data-contract-start-date="{{ $contract->contract_start_date }}"
                                                    data-contract-end-date="{{ $contract->contract_end_date }}"
                                                    data-total-contract-value="{{ $contract->total_contract_value }}"
                                                    data-contract-type-id="{{ $contract->contract_type_id }}"
                                                    data-sesion="{{ $contract->sesion }}"
                                                    data-sesion-date="{{ $contract->sesion_date }}"
                                                    data-employee-type-id="{{ $contract->employee_type_id }}"
                                                    data-SIIF-code="{{ $contract->SIIF_code }}"
                                                    data-insurer-entity="{{ $contract->insurer_entity }}"
                                                    data-policy-number="{{ $contract->policy_number }}"
                                                    data-policy-issue-date="{{ $contract->policy_issue_date }}"
                                                    data-policy-approval-date="{{ $contract->policy_approval_date }}"
                                                    data-policy-effective-date="{{ $contract->policy_effective_date }}"
                                                    data-policy-expiration-date="{{ $contract->policy_expiration_date }}"
                                                    data-risk-type="{{ $contract->risk_type }}"
                                                    data-state="{{ $contract->state }}">Editar</a>
                                                <form action="{{ route('gth.contractors.delete', $contract->id) }}"
                                                    method="POST" id="btnEliminar" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        data-id="{{ $contract->id }}">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Repite este bloque para cada contrato -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Edición -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contrato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($contract))
                        <form id="editForm" method="POST" action="{{ route('gth.contracts.update', $contract->id) }}">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="contractor_id" id="contractor_id" value="">

                            <!-- Campos de formulario para los atributos del contrato -->
                            <div class="mb-3">
                                <label for="contract_number" class="form-label">Número de Contrato:</label>
                                <input type="text" class="form-control" id="contract_number" name="contract_number"
                                    value="{{ old('contract_number', $contract->contract_number) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="contract_start_date" class="form-label">Fecha de Inicio de Contrato:</label>
                                <input type="date" class="form-control" id="contract_start_date"
                                    name="contract_start_date"
                                    value="{{ old('contract_start_date', $contract->contract_start_date) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="contract_end_date" class="form-label">Fecha de Fin de Contrato:</label>
                                <input type="date" class="form-control" id="contract_end_date" name="contract_end_date"
                                    value="{{ old('contract_end_date', $contract->contract_end_date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="total_contract_value" class="form-label">Valor Total del Contrato:</label>
                                <input type="number" class="form-control" id="total_contract_value"
                                    name="total_contract_value"
                                    value="{{ old('total_contract_value', $contract->total_contract_value) }}">
                            </div>
                            <div class="mb-3">
                                <label for="contractor_type_id" class="form-label">Tipo de Contrato:</label>
                                <select name="contractor_type_id" id="contractor_type_id"
                                    class="form-control @error('contractor_type_id') is-invalid @enderror" required>
                                    @foreach ($contractorTypes as $contractorType)
                                        <option value="{{ $contractorType->id }}">{{ $contractorType->name }}</option>
                                    @endforeach
                                </select>
                                @error('contractor_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="employee_type_id" class="form-label">Tipo de Empleado:</label>
                                <select name="employee_type_id" id="employee_type_id"
                                    class="form-control @error('employee_type_id') is-invalid @enderror" required>
                                    <option value="">--- Elija el Tipo de Empleado ---</option>
                                    @foreach ($employeeTypes as $employeeType)
                                        <option value="{{ $employeeType->id }}">{{ $employeeType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sesion" class="form-label">Sesión:</label>
                                <input type="text" class="form-control" id="sesion" name="sesion"
                                    value="{{ old('sesion', $contract->sesion) }}">
                            </div>
                            <div class="mb-3">
                                <label for="sesion_date" class="form-label">Fecha de Sesión:</label>
                                <input type="date" class="form-control" id="sesion_date" name="sesion_date"
                                    value="{{ old('sesion_date', $contract->sesion_date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="SIIF_code" class="form-label">Codigo SIIF:</label>
                                <input type="text" class="form-control" id="SIIF_code" name="SIIF_code"
                                    value="{{ old('SIIF_code', $contract->SIIF_code) }}">
                            </div>
                            <div class="mb-3">
                                <label for="insurer_entity" class="form-label">Entidad Aseguradora:</label>
                                <input type="text" class="form-control" id="insurer_entity" name="insurer_entity"
                                    value="{{ old('insurer_entity', $contract->insurer_entity) }}">
                            </div>
                            <div class="mb-3">
                                <label for="policy_number" class="form-label">Número de Póliza:</label>
                                <input type="text" class="form-control" id="policy_number" name="policy_number"
                                    value="{{ old('policy_number', $contract->policy_number) }}">
                            </div>
                            <div class="mb-3">
                                <label for="policy_issue_date" class="form-label">Fecha de Emisión de la Póliza:</label>
                                <input type="date" class="form-control" id="policy_issue_date"
                                    name="policy_issue_date"
                                    value="{{ old('policy_issue_date', $contract->policy_issue_date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="policy_approval_date" class="form-label">Fecha de Aprobación de la
                                    Póliza:</label>
                                <input type="date" class="form-control" id="policy_approval_date"
                                    name="policy_approval_date"
                                    value="{{ old('policy_approval_date', $contract->policy_approval_date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="policy_effective_date" class="form-label">Fecha de Vigencia de la
                                    Póliza:</label>
                                <input type="date" class="form-control" id="policy_effective_date"
                                    name="policy_effective_date"
                                    value="{{ old('policy_effective_date', $contract->policy_effective_date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="policy_expiration_date" class="form-label">Fecha de Vencimiento de la
                                    Póliza:</label>
                                <input type="date" class="form-control" id="policy_expiration_date"
                                    name="policy_expiration_date"
                                    value="{{ old('policy_expiration_date', $contract->policy_expiration_date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="risk_type" class="form-label">Tipo de Riesgo:</label>
                                <input type="text" class="form-control" id="risk_type" name="risk_type"
                                    value="{{ old('risk_type', $contract->risk_type) }}">
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Estado:</label>
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">--- Seleccione el Estado ---</option>
                                    <option value="Activo" @if (old('state', $contract->state) == 'Activo') selected @endif>Activo
                                    </option>
                                    <option value="Inactivo" @if (old('state', $contract->state) == 'Inactivo') selected @endif>Inactivo
                                    </option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>

                            <button type="button" class="btn btn-primary" id="guardarCambiosBtn">Guardar
                                Cambios</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.editar-btn').click(function() {
                var contract = $(this).data('id');

                // Actualiza el título del modal con el ID del contrato
                $('#exampleModalLabel').text('Editar Contrato - ID: ' + contract);

                // Obtén los atributos de datos relevantes
                var contractNumber = $(this).data('contract-number');
                var contractStartDate = $(this).data('contract-start-date');
                var contractEndDate = $(this).data('contract-end-date');
                var totalContractValue = $(this).data('total-contract-value');
                var contractTypeId = $(this).data('contract-type-id');
                var sesion = $(this).data('sesion');
                var sesionDate = $(this).data('sesion-date');
                var employeeTypeId = $(this).data('employee-type-id'); // Añade esta línea
                var SIIFCode = $(this).data('SIIF-code');
                var insurerEntity = $(this).data('insurer-entity');
                var policyNumber = $(this).data('policy-number');
                var policyIssueDate = $(this).data('policy-issue-date');
                var policyApprovalDate = $(this).data('policy-approval-date');
                var policyEffectiveDate = $(this).data('policy-effective-date');
                var policyExpirationDate = $(this).data('policy-expiration-date');
                var riskType = $(this).data('risk-type');
                var state = $(this).data('state');

                // Llena los campos del formulario en el modal con los datos del contrato
                $('#contractor_id').val(contractId);
                $('#contract_number').val(contractNumber);
                $('#contract_start_date').val(contractStartDate);
                $('#contract_end_date').val(contractEndDate);
                $('#total_contract_value').val(totalContractValue);
                $('#contract_type_id').val(contractTypeId);
                $('#sesion').val(sesion);
                $('#sesion_date').val(sesionDate);
                $('#employee_type_id').val(employeeTypeId); // Añade esta línea
                $('#SIIF_code').val(SIIFCode);
                $('#insurer_entity').val(insurerEntity);
                $('#policy_number').val(policyNumber);
                $('#policy_issue_date').val(policyIssueDate);
                $('#policy_approval_date').val(policyApprovalDate);
                $('#policy_effective_date').val(policyEffectiveDate);
                $('#policy_expiration_date').val(policyExpirationDate);
                $('#risk_type').val(riskType);
                $('#state').val(state);

                // Realiza una solicitud AJAX para obtener más datos del contrato si es necesario
                // Agrega más campos según tus necesidades
            });

            // Manejar el clic en el botón "Guardar Cambios"
            $('#guardarCambiosBtn').click(function() {
                if (confirmarCambios()) {
                    // Si la función confirmarCambios() devuelve verdadero, envía el formulario
                    $('#editForm').submit();
                }
            });

            // Función para mostrar un cuadro de confirmación personalizado
            function confirmarCambios() {
                return confirm("¿Estás seguro de que deseas guardar los cambios?");
            }
        });
    </script>


@endsection

@section('js')
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El contrato ha sido eliminado.',
                'Con éxito'
            )
        </script>
    @endif

    <script>
        document.getElementById("btnEliminar").addEventListener("click", function(event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente
            const contractId = this.getAttribute("data-id"); // Obtiene el ID del contrato

            Swal.fire({
                title: 'Estás Seguro?',
                text: "¡No podrás revertir esto!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endsection
