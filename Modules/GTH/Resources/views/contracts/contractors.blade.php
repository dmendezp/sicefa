@extends('gth::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Reportes de contratos</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                            Crear Contrato
                        </button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tipo Documento</th>
                                    <th>Número Documento</th>
                                    <th>Nombre Completo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractor as $contract)
                                    <tr>
                                        <td>{{ $contract->person->id }}</td>
                                        <td>{{ $contract->person->document_type }}</td>
                                        <td>{{ $contract->person->document_number }}</td>
                                        <td>{{ $contract->person->first_name }} {{ $contract->person->first_last_name }} {{ $contract->person->second_last_name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal" data-bs-target="#editarModal"
                                                data-number="{{ $contract->contract_number }}" 
                                                data-contract-year="{{ $contract->contract_year }}"
                                                data-contract-start-date="{{ $contract->contract_start_date }}" 
                                                data-contract-end-date="{{ $contract->contract_end_date }}"
                                                data-total-contract-value="{{ $contract->total_contract_value }}" 
                                                data-contractor-type-id="{{ $contract->contractor_type_id }}"
                                                data-contract-object="{{ $contract->contract_object }}" 
                                                data-contract-obligations="{{ $contract->contract_obligations }}"
                                                data-amount-hours="{{ $contract->amount_hours }}" 
                                                data-assignment-value="{{ $contract->assigment_value }}"
                                                data-sesion="{{ $contract->sesion }}" 
                                                data-sesion-date="{{ $contract->sesion_date }}"
                                                data-employee-type-id="{{ $contract->employee_type_id }}" 
                                                data-SIIF-code="{{ $contract->SIIF_code }}"
                                                data-insurer-entity-id="{{ $contract->insurer_entity_id }}" 
                                                data-policy-number="{{ $contract->policy_number }}"
                                                data-policy-issue-date="{{ $contract->policy_issue_date }}" 
                                                data-policy-effective-date="{{ $contract->policy_effective_date }}"
                                                data-policy-expiration-date="{{ $contract->policy_expiration_date }}" 
                                                data-risk-type="{{ $contract->risk_type }}"
                                                data-state="{{ $contract->state }}">Editar</a>
                                             
                                                
                                            <form action="{{ route('gth.contractor.delete', $contract->id) }}"
                                                method="POST" class="btnEliminar" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    data-id="{{ $contract->id }}">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Repite este bloque para cada tipo de contrato -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Contrato: {{$contract->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($contract))
                        <!-- Cambiado a $contract -->
                        <form id="editForm" method="POST"
                            action="{{ route('gth.contractortypes.update', ['id' => $contract->id]) }}">
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
                                <input type="date" class="form-control"
                                id="contractor_type_id-{{ $contract->id }}"
                                name="contractor_type_id"
                                value="{{ old('contractor_type_id', $contract->contractor_type_id) }}"
                                required>
                            </div>
                            <div class="mb-3">
                                <label for="employee_type_id-{{ $contract->id }}"
                                    class="form-label">Tipo de Empleado:</label>
                                    <input type="date" class="form-control"
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
@endsection

@section('js')
    <script>
        'use strict';
        // Selecciona todos los formularios con la clase "formEliminar"
        var forms = document.querySelectorAll('.btnEliminar');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    console.log('Formulario enviado'); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "¿Estas seguro que deseas eliminar?",
                        text: "Este proceso es irrevesible.",
                        icon: 'Advertencia',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Si, Elimínalo",
                        cancelButtonText: "Cancelar" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    });
                });
            });
    </script>

<script>
    'use strict';
    var Guardar = document.getElementById('Guardar');

    Guardar.addEventListener('click', function() {
        // Simulamos una operación de guardado exitosa (puedes reemplazar esto con tu lógica real de guardado)
        // Supongamos que aquí tienes tu lógica para guardar datos en el servidor

        // Luego de que se haya completado la operación de guardado, muestra el SweetAlert
        Swal.fire({
            title: 'Guardado exitoso',
            text: 'Los datos se han guardado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    });
</script>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editar-btn').click(function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');

                $('#editId').val(id);
                $('#editName').val(nombre);

                // Obtener la ruta de actualización del formulario de edición
                var updateRoute = '{{ route('gth.contractor.update', ['id' => ':id']) }}'.replace(
                    ':id', id);

                // Asignar la ruta de actualización al formulario de edición
                $('#editForm').attr('action', updateRoute);
            });

            $('#editForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'), // Usar la ruta de acción del formulario
                    method: 'PATCH',
                    data: formData,
                    success: function(response) {
                        // Actualizar la página después de un breve retraso
                        setTimeout(function() {
                            location.reload();
                        }, 1000); // Espera 1 segundo (1000 milisegundos) antes de recargar

                        // Cerrar el modal
                        var modal = new bootstrap.Modal(document.getElementById('editarModal'));
                        modal.hide();
                    }
                });
            });
        });
    </script>
@endpush

