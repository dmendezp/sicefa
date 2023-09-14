@extends('gth::layouts.master')

@section('content')
    <div class="container">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Reporte de Contratos</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo Documento</th>
                                        <th>Número Documento</th>
                                        <th>Nombre Completo</th>
                                        <!-- Agrega más encabezados según tus necesidades -->
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contractors as $contract)
                                        @if ($contract)
                                            <tr>
                                                <td>{{ $contract->person->id }}</td>
                                                <td>{{ $contract->person->document_type }}</td>
                                                <td>{{ $contract->person->document_number }}</td>
                                                <td>{{ $contract->person->first_name }}
                                                    {{ $contract->person->first_last_name }}{{ $contract->person->second_last_name }}
                                                </td>
                                                <!-- Agrega más campos según tus necesidades -->
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Acciones">
                                                        <a href="#" class="btn btn-warning editar-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editarModal-{{ $contract->id }}"
                                                            data-id="{{ $contract->id }}">Editar</a>

                                                        <form action="{{ route('gth.contractors.destroy', $contract->id) }}"
                                                            method="POST" id="btnEliminar-{{ $contract->id }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                data-id="{{ $contract->id }}">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                        <!-- Modal de Edición para cada contrato -->
                                        <div class="modal fade" id="editarModal-{{ $contract->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Contrato</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('gth.contractors.update', $contract->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('POST')

                                                            <!-- Agrega un campo de formulario oculto para almacenar el ID del contrato actualmente editado -->
                                                            <input type="hidden" id="currentContractId-{{ $contract->id }}"
                                                                name="currentContractId" value="{{ $contract->id }}">

                                                            <!-- Campos de formulario para los atributos del contrato -->
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
                                                                <select name="contractor_type_id" id="contractor_type_id"
                                                                    class="form-control @error('contractor_type_id') is-invalid @enderror"
                                                                    required>
                                                                    @foreach ($contractorTypes as $contractorType)
                                                                        <option value="{{ $contractorType->id }}">
                                                                            {{ $contractorType->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employee_type_id-{{ $contract->id }}"
                                                                    class="form-label">Tipo de Empleado:</label>
                                                                <select name="employee_type_id" id="employee_type_id"
                                                                    class="form-control @error('employee_type_id') is-invalid @enderror"
                                                                    required>
                                                                    @foreach ($employeeTypes as $employeeType)
                                                                        <option value="{{ $employeeType->id }}">
                                                                            {{ $employeeType->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
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
                                                            <!-- Agrega más campos aquí -->
                                                            <!-- Mensajes de error de validación -->
                                                            @error('contract_number')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <button type="submit" class="btn btn-primary"
                                                                id="guardarCambiosBtn-{{ $contract->id }}">Guardar
                                                                Cambios</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modales para ver detalles de contrato -->
    @foreach ($contractors as $contract)
        <div class="modal fade" id="contractDetailsModal{{ $contract->id }}" tabindex="-1" role="dialog"
            aria-labelledby="contractDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contractDetailsModalLabel">Detalles del contrato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tabla para mostrar detalles del contrato -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Campo</th>
                                    <th>Información</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Número de Contrato</td>
                                    <td>{{ $contract->contract_number }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha de Inicio de Contrato</td>
                                    <td>{{ $contract->contract_start_date }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha de Fin de Contrato</td>
                                    <td>{{ $contract->contract_end_date }}</td>
                                </tr>
                                <tr>
                                    <td>Valor Total Contrato</td>
                                    <td>{{ $contract->total_contract_value }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo Contrato</td>
                                    <td>{{ $contract->contractor_type_id }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo Empleado</td>
                                    <td>{{ $contract->employee_type_id }}</td>
                                </tr>
                                <tr>
                                    <td>Sesión</td>
                                    <td>{{ $contract->sesion }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Sesión</td>
                                    <td>{{ $contract->sesion_date }}</td>
                                </tr>
                                <tr>
                                    <td>Código SIIF</td>
                                    <td>{{ $contract->SIIF_code }}</td>
                                </tr>
                                <tr>
                                    <td>Entidad Aseguradora</td>
                                    <td>{{ $contract->insurer_entity }}</td>
                                </tr>
                                <tr>
                                    <td>Número Póliza</td>
                                    <td>{{ $contract->policy_number }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Emisión Póliza</td>
                                    <td>{{ $contract->policy_issue_date }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Aprobación Póliza</td>
                                    <td>{{ $contract->policy_approval_date }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Vigencia Póliza</td>
                                    <td>{{ $contract->policy_effective_date }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Vencimiento Póliza</td>
                                    <td>{{ $contract->policy_expiration_date }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo de Riesgo</td>
                                    <td>{{ $contract->risk_type }}</td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td>{{ $contract->state }}</td>
                                </tr>
                                <!-- Agrega más filas según tus necesidades -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        $('.editar-btn').on('click', function() {
            var contractorId = $(this).data('id');
            $('#currentContractId').val(contractorId);

            // Obtén los datos del contrato mediante una solicitud AJAX y actualiza el formulario del modal
            $.ajax({
                url: '{{ route('gth.contractors.show', ':id') }}'.replace(':id', contractorId),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Actualiza los campos del formulario con los datos del contrato
                    $('#person_id').val(data.person_id);
                    $('supervisor_id').val(data.supervisor_id);
                    $('#contract_number').val(data.contract_number);
                    $('#contract_year').val(data.contract_year);
                    $('#contract_start_date').val(data.contract_start_date);
                    $('#contract_end_date').val(data.contract_end_date);
                    $('#total_contract_value').val(data.total_contract_value);
                    $('#contract_type_id').val(data.contract_type_id);
                    $('#contract_object').val(data.contract_object);
                    $('#contract_obligations').val(data.contract_obligations);
                    $('#amount_hours').val(data.amount_hours);
                    $('#assigment_value').val(data.assigment_value);
                    $('#sesion').val(data.sesion);
                    $('#sesion_date').val(data.sesion_date);
                    $('#employee_type_id').val(data.employee_type_id);
                    $('#SIIF_code').val(data.SIIF_code);
                    $('#insurer_entity_id').val(data.insurer_entity_id);
                    $('#policy_number').val(data.policy_number);
                    $('#policy_issue_date').val(data.policy_issue_date);
                    $('#policy_approval_date').val(data.policy_approval_date);
                    $('#policy_effective_date').val(data.policy_effective_date);
                    $('#policy_expiration_date').val(data.policy_expiration_date);
                    $('#risk_type').val(data.risk_type);
                    $('#state').val(data.state);
                    // Actualiza más campos aquí

                    // Actualiza la acción del formulario para enviar los datos al contrato correcto
                    $('#editForm-' + contractorId).attr('action',
                        '{{ route('gth.contractors.update', ':id') }}'.replace(':id', contractorId)
                        );
                },
                error: function(xhr, status, error) {
                    // Maneja errores si es necesario
                    console.error(error);
                }
            });
        });
    </script>
@endsection
