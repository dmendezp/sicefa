    @extends('gth::layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>{{ trans('gth::menu.Employment Contract Record') }}</h1>
            </div>
            <div class="card-body">
                <form method="POST"  action="{{ route('cefa.gth.contractreports.store') }}">
                    @csrf

                    <!-- Información de la Persona -->
                    <h2>{{ trans('gth::menu.Personal Information') }}</h2>
                    <input type="hidden" name="person_id" id="person_id">
                    <!-- Número de Documento -->
                    <div class="form-group">
                        <label for="document_number">{{ trans('gth::menu.ID number:') }}</label>
                        <input type="number" name="document_number" id="document_number"
                            class="form-control @error('document_number') is-invalid @enderror"
                            value="{{ old('document_number') }}" required>
                        @error('document_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="first_name">{{ trans('gth::menu.First Name:') }}</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="first_last_name">{{ trans('gth::menu.First Surname:') }}</label>
                        <input type="text" name="first_last_name" id="first_last_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="second_last_name">{{ trans('gth::menu.Second Surname:') }}</label>
                        <input type="text" name="second_last_name" id="second_last_name" class="form-control" readonly>
                    </div>
                    <div class="container">
                        <h2>{{ trans('gth::menu.Personal Supervisor') }}</h2>

                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="hidden" name="supervisor_id" id="supervisor_id">
                                    <!-- Número de Documento -->
                                    <div class="form-group">
                                        <label for="document_number_supervisor">{{ trans('gth::menu.ID number:') }}</label>
                                        <input type="number" name="document_number_supervisor" id="document_number_supervisor"
                                            class="form-control @error('document_number_supervisor') is-invalid @enderror"
                                            value="{{ old('document_number_supervisor') }}" required>
                                        @error('document_number_supervisor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="first_name_supervisor">{{ trans('gth::menu.First Name:') }}</label>
                                        <input type="text" name="first_name_supervisor" id="first_name_supervisor" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="first_last_name_supervisor">{{ trans('gth::menu.First Surname:') }}</label>
                                        <input type="text" name="first_last_name_supervisor" id="first_last_name_supervisor" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="second_last_name_supervisor">{{ trans('gth::menu.Second Surname:') }}</label>
                                        <input type="text" name="second_last_name_supervisor" id="second_last_name_supervisor" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 1: Detalles del Contrato -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_number">{{ trans('gth::menu.Contract Number:') }}</label>
                                        <input type="text" name="contract_number" id="contract_number"
                                            class="required form-control @error('contract_number') is-invalid @enderror"
                                            value="{{ old('contract_number') }}" placeholder="{{ trans('gth::menu.Enter the contract number') }}" required>
                                        @error('contract_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_year">{{ trans('gth::menu.Contract Year:') }}</label>
                                        <input type="text" name="contract_year" id="contract_year"
                                            class="required form-control @error('contract_year') is-invalid @enderror"
                                            value="{{ old('contract_year', date('Y')) }}" required>
                                        @error('contract_year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_start_date">{{ trans('gth::menu.Contract Start Date:') }}</label>
                                        <input type="date" name="contract_start_date" id="contract_start_date"
                                            class="required form-control @error('contract_start_date') is-invalid @enderror"
                                            value="{{ old('contract_start_date') }}" required>
                                        @error('contract_start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_end_date">{{ trans('gth::menu.Contract End Date:') }}</label>
                                        <input type="date" name="contract_end_date" id="contract_end_date"
                                            class="required form-control @error('contract_end_date') is-invalid @enderror"
                                            value="{{ old('contract_end_date') }}">
                                        @error('contract_end_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Detalles del Contrato -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contractor_type_id">{{ trans('gth::menu.Type of Contract:') }}</label>
                                        <select name="contractor_type_id" id="contractor_type_id"
                                            class="required form-control @error('contractor_type_id') is-invalid @enderror" required>
                                            <option value="">{{ trans('gth::menu.---Choose the Contract Type---') }}</option>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="employee_type_id">{{ trans('gth::menu.Type of Employee:') }}</label>
                                        <select name="employee_type_id" id="employee_type_id"
                                            class="required form-control @error('employee_type_id') is-invalid @enderror" required>
                                            <option value="">{{ trans('gth::menu.--- Choose the Employee Type ---') }}</option>
                                            @foreach ($employeeTypes as $employeeTypes)
                                                <option value="{{ $employeeTypes->id }}">{{ $employeeTypes->name }}
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

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="amount_hours">{{ trans('gth::menu.Hours of Work:') }}</label>
                                        <input type="number" name="amount_hours" id="amount_hours"
                                            class="required form-control @error('amount_hours') is-invalid @enderror"
                                            value="{{ old('amount_hours') }}" placeholder="{{ trans('gth::menu.Enter the working hours') }}" required>
                                        @error('amount_hours')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="total_contract_value">{{ trans('gth::menu.Total Contract Value:') }}</label>
                                        <input type="number" name="total_contract_value" id="total_contract_value"
                                            class="required form-control @error('total_contract_value') is-invalid @enderror"
                                            value="{{ old('total_contract_value') }}" placeholder="{{ trans('gth::menu.Enter the total value of the contract') }}" required>
                                        @error('total_contract_value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sección 4: Detalles  -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="policy_issue_date">{{ trans('gth::menu.Policy Issuance Date:') }}</label>
                                        <input type="date" name="policy_issue_date" id="policy_issue_date"
                                            class="required form-control @error('policy_issue_date') is-invalid @enderror"
                                            value="{{ old('policy_issue_date') }}" required>
                                        @error('policy_issue_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="policy_approval_date">{{ trans('gth::menu.Policy Approval Date:') }}</label>
                                        <input type="date" name="policy_approval_date" id="policy_approval_date"
                                            class="required form-control @error('policy_approval_date') is-invalid @enderror"
                                            value="{{ old('policy_approval_date') }}" required>
                                        @error('policy_approval_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="policy_effective_date">{{ trans('gth::menu.Policy Effective Date:') }}</label>
                                        <input type="date" name="policy_effective_date" id="policy_effective_date"
                                            class="required form-control @error('policy_effective_date') is-invalid @enderror"
                                            value="{{ old('policy_effective_date') }}" required>
                                        @error('policy_effective_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="policy_expiration_date">{{ trans('gth::menu.Policy Expiration Date:') }}</label>
                                        <input type="date" name="policy_expiration_date" id="policy_expiration_date"
                                            class="required form-control @error('policy_expiration_date') is-invalid @enderror"
                                            value="{{ old('policy_expiration_date') }}" required>
                                        @error('policy_expiration_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sección 4: Detalles  -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="policy_number">{{ trans('gth::menu.Policy Number:') }}</label>
                                        <div class="input-group">
                                            <input type="text" name="policy_number" id="policy_number"
                                                class="required form-control @error('policy_number') is-invalid @enderror"
                                                value="{{ old('policy_number') }}" placeholder="{{ trans('gth::menu.Enter Policy Number') }}">
                                            <div class="input-group-append">
                                            </div>
                                        </div>
                                        @error('policy_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="risk_type">{{ trans('gth::menu.Type of Risk:') }}</label>
                                        <select name="risk_type" id="risk_type"
                                            class="required form-control @error('risk_type') is-invalid @enderror"required>
                                            <option value="">{{ trans('gth::menu.---Choose the Type of Risk---') }}</option>
                                            <option value="I" {{ old('risk_type') == 'I' ? 'selected' : '' }}>I</option>
                                            <option value="II" {{ old('risk_type') == 'II' ? 'selected' : '' }}>II</option>
                                            <option value="III" {{ old('risk_type') == 'III' ? 'selected' : '' }}>III</option>
                                            <option value="IV" {{ old('risk_type') == 'IV' ? 'selected' : '' }}>IV</option>
                                            <option value="V" {{ old('risk_type') == 'V' ? 'selected' : '' }}>V</option>
                                        </select>
                                        @error('risk_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">{{ trans('gth::menu.Status:') }}</label>
                                        <select name="state" id="state"
                                            class="required form-control @error('state') is-invalid @enderror">
                                            <option value="#">{{ trans('gth::menu.--- Choose the contractors status ---') }}</option>
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
                        <!-- Sección 3: Detalles del Contrato -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="SIIF_code">{{ trans('gth::menu.SIIF Code:') }}</label>
                                        <input type="number" name="SIIF_code" id="SIIF_code"
                                            class="required form-control @error('SIIF_code') is-invalid @enderror"
                                            value="{{ old('SIIF_code') }}" placeholder="{{ trans('gth::menu.Enter the assignment value') }}" required>
                                        @error('SIIF_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="assigment_value">{{ trans('gth::menu.Assignment Value:') }}</label>
                                        <input type="number" name="assigment_value" id="assigment_value"
                                            class="required form-control @error('assigment_value') is-invalid @enderror"
                                            value="{{ old('assigment_value') }}" placeholder="{{ trans('gth::menu.Enter the assignment value') }}" required>
                                        @error('assigment_value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="insurer_entity_id">{{ trans('gth::menu.Insurance Company:') }}</label>
                                        <select name="insurer_entity_id" id="insurer_entity_id"
                                            class="required form-control @error('insurer_entity_id') is-invalid @enderror" required>
                                            <option value="">{{ trans('gth::menu.--- Choose the insurance entity ---') }}</option>
                                            @foreach ($insurerEntity as $insurerEntity)
                                                <option value="{{ $insurerEntity->id }}">{{ $insurerEntity->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-14">
                                    <div class="form-group">
                                        <label for="contract_object">{{ trans('gth::menu.Contract Object:') }}</label>
                                        <textarea name="contract_object" id="contract_object"
                                            class="required form-control @error('contract_object') is-invalid @enderror" placeholder="{{ trans('gth::menu.Enter the subject of the contract') }}" required>{{ old('contract_object') }}</textarea>
                                        @error('contract_object')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-14">
                                    <div class="form-group">
                                        <label for="contract_obligations">{{ trans('gth::menu.Contract Obligations:') }}</label>
                                        <textarea name="contract_obligations" id="contract_obligations"
                                            class="required form-control @error('contract_obligations') is-invalid @enderror" placeholder="{{ trans('gth::menu.Enter the obligations of the contract') }}" required>{{ old('contract_obligations') }}</textarea>
                                        @error('contract_obligations')
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
            <button type="submit" class="btn btn-success btnGuardar" id="guardarContrato">{{ trans('gth::menu.Save Contract') }}</button>
            </form>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        // Detecta cambios en el campo "Número de Documento"
        $('#document_number').on('change', function() {
            var numeroDocumento = $(this).val();

            // Realiza una solicitud AJAX para obtener los datos de la persona
            $.ajax({
                url: '{{ route('cefa.gth.getPersonData') }}', // Utiliza la ruta configurada en web.php
                method: 'GET',
                data: {
                    document_number: numeroDocumento
                },
                success: function(data) {
                    // Rellena los campos con los datos de la persona
                    $('#person_id').val(data.id);
                    $('#first_name').val(data.first_name);
                    $('#first_last_name').val(data.first_last_name);
                    $('#second_last_name').val(data.second_last_name);
                },
                error: function() {
                    // Maneja errores si es necesario
                }
            });
        });
        $('#document_number_supervisor').on('change', function() {
            var numeroDocumento = $(this).val();

            // Realiza una solicitud AJAX para obtener los datos de la persona
            $.ajax({
                url: '{{ route('cefa.gth.getPersonData') }}', // Utiliza la ruta configurada en web.php
                method: 'GET',
                data: {
                    document_number: numeroDocumento
                },
                success: function(data) {
                    // Rellena los campos con los datos de la persona
                    $('#supervisor_id').val(data.id);
                    $('#first_name_supervisor').val(data.first_name);
                    $('#first_last_name_supervisor').val(data.first_last_name);
                    $('#second_last_name_supervisor').val(data.second_last_name);
                },
                error: function() {
                    // Maneja errores si es necesario
                }
            });
        });
    </script>



@endsection
