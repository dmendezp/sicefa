@extends('gth::layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Registro de Contrato Laboral</h1>
            </div>
            <div class="card-body">
                <form method="POST"  action="{{ route('gth.contractreports.store') }}">
                    @csrf


                    <!-- Información de la Persona -->
                    <h2>Información de la Persona</h2>

                    <!-- Número de Documento -->
                    <div class="form-group">
                        <label for="document_number">Número de Documento:</label>
                        <input type="number" name="document_number" id="document_number"
                            class="form-control @error('document_number') is-invalid @enderror"
                            value="{{ old('document_number') }}" required>
                        @error('document_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Nombre de la Persona -->
                    <div class="form-group">
                        <label for="first_name">Primer Nombre:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="first_last_name">Primer Apellido:</label>
                        <input type="text" name="first_last_name" id="first_last_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="second_last_name">Segundo Apellido:</label>
                        <input type="text" name="second_last_name" id="second_last_name" class="form-control" readonly>
                    </div>

                    <!-- Información del Contrato -->
                    <div class="containe+r">
                        <h2>Información del Contrato</h2>

                        <!-- Sección 1: Datos Básicos del Contrato -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="contract_number">Número de Contrato:</label>
                                        <input type="text" name="contract_number" id="contract_number"
                                            class="form-control @error('contract_number') is-invalid @enderror"
                                            value="{{ old('contract_number') }}" required>
                                        @error('contract_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="contract_start_date">Fecha Inicio Contrato:</label>
                                        <input type="date" name="contract_start_date" id="contract_start_date"
                                            class="form-control @error('contract_start_date') is-invalid @enderror"
                                            value="{{ old('contract_start_date') }}" required>
                                        @error('contract_start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="contract_end_date">Fecha Fin Contrato:</label>
                                        <input type="date" name="contract_end_date" id="contract_end_date"
                                            class="form-control @error('contract_end_date') is-invalid @enderror"
                                            value="{{ old('contract_end_date') }}">
                                        @error('contract_end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="total_contract_value">Valor Total del Contrato:</label>
                                        <input type="number" name="total_contract_value" id="total_contract_value"
                                            class="form-control @error('total_contract_value') is-invalid @enderror"
                                            value="{{ old('total_contract_value') }}">
                                        @error('total_contract_value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="contractor_type_id">Tipo de Contrato:</label>
                                        <select name="contractor_type_id" id="contractor_type_id"
                                            class="form-control @error('contractor_type_id') is-invalid @enderror" required>
                                            <option value="">--- Elija el Tipo de Contrato ---</option>
                                            @foreach ($contractorTypes as $contractorType)
                                                <option value="{{ $contractorType->id }}">{{ $contractorType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('contractor_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="sesion">Sesión:</label>
                                        <input type="text" name="sesion" id="sesion"
                                            class="form-control @error('sesion') is-invalid @enderror"
                                            value="{{ old('sesion') }}">
                                        @error('sesion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="sesion_date">Fecha de Sesión:</label>
                                        <input type="date" name="sesion_date" id="sesion_date"
                                            class="form-control @error('sesion_date') is-invalid @enderror"
                                            value="{{ old('sesion_date') }}">
                                        @error('sesion_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="employee_type_id">Tipo de Empleado:</label>
                                        <select name="employee_type_id" id="employee_type_id"
                                            class="form-control @error('employee_type_id') is-invalid @enderror" required>
                                            <option value="">--- Elija el Tipo de Empleado ---</option>
                                            @foreach ($employeeTypes as $employeeType)
                                                <option value="{{ $employeeType->id }}">{{ $employeeType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="SIIF_code">Código SIIF:</label>
                                        <input type="text" name="SIIF_code" id="SIIF_code"
                                            class="form-control @error('SIIF_code') is-invalid @enderror"
                                            value="{{ old('SIIF_code') }}">
                                        @error('SIIF_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="insurer_entity">Entidad Aseguradora:</label>
                                        <input type="text" name="insurer_entity" id="insurer_entity"
                                            class="form-control @error('insurer_entity') is-invalid @enderror"
                                            value="{{ old('insurer_entity') }}">
                                        @error('insurer_entity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="policy_number">Número de Póliza:</label>
                                        <input type="text" name="policy_number" id="policy_number"
                                            class="form-control @error('policy_number') is-invalid @enderror"
                                            value="{{ old('policy_number') }}">
                                        @error('policy_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="policy_issue_date">Fecha de Emisión de la Póliza:</label>
                                        <input type="date" name="policy_issue_date" id="policy_issue_date"
                                            class="form-control @error('policy_issue_date') is-invalid @enderror"
                                            value="{{ old('policy_issue_date') }}">
                                        @error('policy_issue_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="policy_approval_date">Fecha de Aprobación de la Póliza:</label>
                                        <input type="date" name="policy_approval_date" id="policy_approval_date"
                                            class="form-control @error('policy_approval_date') is-invalid @enderror"
                                            value="{{ old('policy_approval_date') }}">
                                        @error('policy_approval_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="policy_effective_date">Fecha de Vigencia de la Póliza:</label>
                                        <input type="date" name="policy_effective_date" id="policy_effective_date"
                                            class="form-control @error('policy_effective_date') is-invalid @enderror"
                                            value="{{ old('policy_effective_date') }}">
                                        @error('policy_effective_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="policy_expiration_date">Fecha de Vencimiento de la Póliza:</label>
                                        <input type="date" name="policy_expiration_date" id="policy_expiration_date"
                                            class="form-control @error('policy_expiration_date') is-invalid @enderror"
                                            value="{{ old('policy_expiration_date') }}">
                                        @error('policy_expiration_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="risk_type">Tipo de Riesgo:</label>
                                        <input type="text" name="risk_type" id="risk_type"
                                            class="form-control @error('risk_type') is-invalid @enderror"
                                            value="{{ old('risk_type') }}">
                                        @error('risk_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="state">Estado:</label>
                                        <select name="state" id="state"
                                            class="form-control @error('state') is-invalid @enderror">
                                            <option value="#">--- Elija el estado del contratista</option>
                                            <option value="Activo" {{ old('state') === 'Activo' ? 'selected' : '' }}>
                                                Activo</option>
                                            <option value="Inactivo" {{ old('state') === 'Inactivo' ? 'selected' : '' }}>
                                                Inactivo</option>
                                        </select>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
            </div>
            <br><br>
            <button type="submit" class="btn btn-success btnGuardar" id="guardarContrato">Guardar Contrato</button>
            </form>
        </div>

    </div>
    </div>

    <script>
        // Detecta cambios en el campo "Número de Documento"
        $('#document_number').on('change', function() {
            var numeroDocumento = $(this).val();

            // Realiza una solicitud AJAX para obtener los datos de la persona
            $.ajax({
                url: '{{ route('gth.getPersonData') }}', // Utiliza la ruta configurada en web.php
                method: 'GET',
                data: {
                    document_number: numeroDocumento
                },
                success: function(data) {
                    // Rellena los campos con los datos de la persona
                    $('#first_name').val(data.first_name);
                    $('#first_last_name').val(data.first_last_name);
                    $('#second_last_name').val(data.second_last_name);
                },
                error: function() {
                    // Maneja errores si es necesario
                }
            });
        });
    </script>
 <script>
    'use strict';
    var guardarContrato = document.getElementById('guardarContrato');

    guardarContrato.addEventListener('click', function() {
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
