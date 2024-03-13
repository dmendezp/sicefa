@extends('gth::layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">{{ trans('gth::menu.Contract reports') }}</h1>
                        <table id="contractor" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('gth::menu.Document type') }}</th>
                                    <th scope="col">{{ trans('gth::menu.ID number') }}</th>
                                    <th scope="col">{{ trans('gth::menu.Full name') }}</th>
                                    <th style="width: 200px;">{{ trans('gth::menu.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractor as $contract)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contract->person->document_type }}</td>
                                        <td>{{ $contract->person->document_number }}</td>
                                        <td>{{ $contract->person->full_name }}</td>
                                        <form action="{{ route('cefa.gth.contractor.delete', $contract->id) }}"
                                            method="POST" class="btnEliminar" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editarModal_{{ $contract->id }}"
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
                                                    data-employee-type-id="{{ $contract->employee_type_id }}"
                                                    data-SIIF-code="{{ $contract->SIIF_code }}"
                                                    data-insurer-entity-id="{{ $contract->insurer_entity_id }}"
                                                    data-policy-number="{{ $contract->policy_number }}"
                                                    data-policy-issue-date="{{ $contract->policy_issue_date }}"
                                                    data-policy-effective-date="{{ $contract->policy_effective_date }}"
                                                    data-policy-expiration-date="{{ $contract->policy_expiration_date }}"
                                                    data-risk-type="{{ $contract->risk_type }}"
                                                    data-state="{{ $contract->state }}">{{ trans('gth::menu.Edit') }}</a>
                                                <button type="submit" class="btn btn-danger"
                                                    data-id="{{ $contract->id }}">{{ trans('gth::menu.Delete') }}</button>
                                            </td>
                                        </form>
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
    @foreach ($contractor as $contract)
        <div class="modal fade" id="editarModal_{{ $contract->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('gth::menu.Edit Contract') }}
                            {{ $contract->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($contract))
                            <!-- Cambiado a $contract -->
                            <form id="editForm" method="POST"
                                action="{{ route('cefa.gth.contractor.update', ['id' => $contract->id]) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id"
                                    value="{{ $contract->id }}"><!-- Cambiado a $contract -->


                                <!-- Sección 1: Detalles del Contrato -->
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="contract_number-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Contract Number') }}</label>
                                                <input type="text" class="form-control"
                                                    id="contract_number-{{ $contract->id }}" name="contract_number"
                                                    value="{{ old('contract_number', $contract->contract_number) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="contract_year-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Contract Year:') }}</label>
                                                <input type="text" class="form-control"
                                                    id="contract_year-{{ $contract->id }}" name="contract_year"
                                                    value="{{ old('contract_year', $contract->contract_year) }}"required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="contract_start_date-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Contract Start Date:') }}</label>
                                                <input type="date" class="form-control"
                                                    id="contract_start_date-{{ $contract->id }}" name="contract_start_date"
                                                    value="{{ old('contract_start_date', $contract->contract_start_date) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="contract_end_date-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Contract End Date:') }}</label>
                                                <input type="date" class="form-control"
                                                    id="contract_end_date-{{ $contract->id }}" name="contract_end_date"
                                                    value="{{ old('contract_end_date', $contract->contract_end_date) }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="contractor_type_id-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Type of Contract:') }}</label>
                                                <select name="contractor_type_id" id="contractor_type_id"
                                                    class="form-control @error('contractor_type_id') is-invalid @enderror"
                                                    required>
                                                    @foreach ($contractorTypes as $contractorType)
                                                        <option value="{{ $contractorType->id }}"
                                                            {{ $contractorType->id == $contract->contractor_type_id ? 'selected' : '' }}>
                                                            {{ $contractorType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="employee_type_id-{{ $contract->id }}" class="form-label">{{ trans('gth::menu.Type of Employee:') }}</label>
                                                <select name="employee_type_id" id="employee_type_id"
                                                    class="form-control @error('employee_type_id') is-invalid @enderror"
                                                    required>
                                                    @foreach ($employeeTypes as $employeeType)
                                                        <option value="{{ $employeeType->id }}"
                                                            {{ $employeeType->id == $contract->employee_type_id ? 'selected' : '' }}>
                                                            {{ $employeeType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="amount_hours-{{ $contract->id }}" class="form-label">{{ trans('gth::menu.Hours of Work:') }}</label>
                                                <input type="text" class="form-control"
                                                    id="amount_hours-{{ $contract->id }}" name="amount_hours"
                                                    value="{{ old('amount_hours', $contract->amount_hours) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="total_contract_value-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Total Contract Value:') }}</label>
                                                <input type="text" class="form-control"
                                                    id="total_contract_value-{{ $contract->id }}"
                                                    name="total_contract_value"
                                                    value="{{ old('total_contract_value', $contract->total_contract_value) }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="policy_issue_date-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Policy Issuance Date:') }}</label>
                                                <input type="date" class="form-control"
                                                    id="policy_issue_date-{{ $contract->id }}" name="policy_issue_date"
                                                    value="{{ old('policy_issue_date', $contract->policy_issue_date) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="policy_approval_date-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Policy Approval Date:') }}</label>
                                                <input type="date" class="form-control"
                                                    id="policy_approval_date-{{ $contract->id }}"
                                                    name="policy_approval_date"
                                                    value="{{ old('policy_approval_date', $contract->policy_approval_date) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="policy_effective_date-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Policy Effective Date:') }}</label>
                                                <input type="date" class="form-control"
                                                    id="policy_effective_date-{{ $contract->id }}"
                                                    name="policy_effective_date"
                                                    value="{{ old('policy_effective_date', $contract->policy_effective_date) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="policy_expiration_date-{{ $contract->id }}"
                                                    class="form-label">{{ trans('gth::menu.Policy Expiration Date:') }}</label>
                                                <input type="date" class="form-control"
                                                    id="policy_expiration_date-{{ $contract->id }}"
                                                    name="policy_expiration_date"
                                                    value="{{ old('policy_expiration_date', $contract->policy_expiration_date) }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="policy_number-{{ $contract->id }}" class="form-label">{{ trans('gth::menu.Policy Number:') }}</label>
                                                <input type="text" class="form-control"
                                                    id="policy_number-{{ $contract->id }}" name="policy_number"
                                                    value="{{ old('policy_number', $contract->policy_number) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="risk_type">{{ trans('gth::menu.Type of Risk:') }}</label>
                                                <select name="risk_type" id="risk_type"
                                                    class="form-control @error('risk_type') is-invalid @enderror" required>
                                                    <option value="I"
                                                        {{ old('risk_type', $contract->risk_type) == 'I' ? 'selected' : '' }}>
                                                        I
                                                    </option>
                                                    <option value="II"
                                                        {{ old('risk_type', $contract->risk_type) == 'II' ? 'selected' : '' }}>
                                                        II
                                                    </option>
                                                    <option value="III"
                                                        {{ old('risk_type', $contract->risk_type) == 'III' ? 'selected' : '' }}>
                                                        III
                                                    </option>
                                                    <option value="IV"
                                                        {{ old('risk_type', $contract->risk_type) == 'IV' ? 'selected' : '' }}>
                                                        IV
                                                    </option>
                                                    <option value="V"
                                                        {{ old('risk_type', $contract->risk_type) == 'V' ? 'selected' : '' }}>
                                                        V
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="state">{{ trans('gth::menu.Status:') }}</label>
                                                <select name="state" id="state"
                                                    class="form-control @error('state') is-invalid @enderror">
                                                    <option value="Activo"
                                                        {{ old('state', $contract->state) === 'Activo' ? 'selected' : '' }}>
                                                        Activo</option>
                                                    <option value="Inactivo"
                                                        {{ old('state', $contract->state) === 'Inactivo' ? 'selected' : '' }}>
                                                        Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="SIIF_code-{{ $contract->id }}" class="form-label">{{ trans('gth::menu.SIIF code:') }}</label>
                                                <input type="text" class="form-control"
                                                    id="SIIF_code-{{ $contract->id }}" name="SIIF_code"
                                                    value="{{ old('SIIF_code', $contract->SIIF_code) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="assigment_value-{{ $contract->id }}"
                                                        class="form-label">{{ trans('gth::menu.Assignment Value:') }}</label>
                                                    <input type="text" class="form-control"
                                                        id="assigment_valuee-{{ $contract->id }}" name="assigment_value"
                                                        value="{{ old('assigment_value', $contract->assigment_value) }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="insurer_entity_id">{{ trans('gth::menu.Insurance Company:') }}</label>
                                                    <select name="insurer_entity_id" id="insurer_entity_id"
                                                        class="form-control @error('insurer_entity_id') is-invalid @enderror"
                                                        required>
                                                        @foreach ($insurerEntitys as $insurerEntity)
                                                            <option value="{{ $insurerEntity->id }}"
                                                                {{ $insurerEntity->id == $contract->insurer_entity_id ? 'selected' : '' }}>
                                                                {{ $insurerEntity->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-header">
                                            <div class="col-md-14">
                                                <div class="form-group">
                                                    <label for="contract_object-{{ $contract->id }}"
                                                        class="form-label">{{ trans('gth::menu.Contract Object:') }}</label>
                                                    <input type="text" class="form-control"
                                                        id="contract_object-{{ $contract->id }}" name="contract_object"
                                                        value="{{ old('contract_object', $contract->contract_object) }}"
                                                        required>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="card-header">
                                            <div class="col-md-14">
                                                <div class="form-group">
                                                    <label for="contract_obligations-{{ $contract->id }}"
                                                        class="form-label">{{ trans('gth::menu.Contract Obligations:') }}</label>
                                                    <input type="text" class="form-control"
                                                        id="contract_obligations-{{ $contract->id }}"
                                                        name="contract_obligations"
                                                        value="{{ old('contract_obligations', $contract->contract_obligations) }}"
                                                        required>
                                                </div>
                                            </div>
                                                </div>
                                            

                                            <!-- Resto del formulario -->
                                            <button type="submit" class="btn btn-primary"
                                                onclick="return confirmarCambios()">{{ trans('gth::menu.Save Changes') }}</button>
                                                </div>
                                        </div>
                                    </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script>
        new DataTable('#contractor');
    </script>

    <script>
        function confirmarCambios() {
            Swal.fire({
                title: {{ trans('gth::menu.Saved successful') }},
                text: {{ trans('gth::menu.The data has been saved correctly.') }},
                icon: {{ trans('gth::menu.success') }},
                confirmButtonText: {{ trans('gth::menu.Accept') }},
            });
        }
    </script>

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
                        title: {{ trans('gth::menu.¿Are you sure you want to delete?') }},
                        text: {{ trans('gth::menu.This process is irreversible.') }},
                        icon: {{ trans('gth::menu.Warning') }},
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: {{ trans('gth::menu.Yes, delete it') }},
                        cancelButtonText: {{ trans('gth::menu.Cancel') }}, // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: {{ trans('gth::menu.success') }},
                                title: {{ trans('gth::menu.Tu trabajo ha sido guardado.') }},
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
                title: {{ trans('gth::menu.Saved successful') }},
                text: {{ trans('gth::menu.The data has been saved correctly.') }},
                icon: {{ trans('gth::menu.success') }},
                confirmButtonText: {{ trans('gth::menu.Accept') }},
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: {{ trans('gth::menu.success') }},
                title: {{ trans('gth::menu.success!') }},
                text: {{ session('success') }},
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: {{ trans('gth::menu.Error!') }},
                title: {{ trans('gth::menu.Error!') }} ,
                text: {{ session('error') }},
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif
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
                var updateRoute = '{{ route('cefa.gth.contractor.update', ['id' => ':id']) }}'.replace(
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
