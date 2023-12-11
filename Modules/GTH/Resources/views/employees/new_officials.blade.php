<div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Funcionario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cefa.gth.store') }}" method="POST">
                    @csrf
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
                        <label for="full_name">Nombre</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" readonly>
                    </div>
                    <input type="hidden" name="person_id" id="person_id" value="">

                    <div class="form-group">
                        <label for="contract_number">Número de contrato</label>
                        <input type="text" class="form-control" id="contract_number" name="contract_number"
                            placeholder="Ingrese el número de contrato">
                    </div>

                    <div class="form-group">
                        <label for="contract_date">Fecha de contrato</label>
                        <input type="date" class="form-control" id="contract_date" name="contract_date"
                            placeholder="Ingrese la fecha de contrato">
                    </div>

                    <div class="form-group">
                        <label for="professional_card_number">Número de tarjeta profesional</label>
                        <input type="text" class="form-control" id="professional_card_number"
                            name="professional_card_number" placeholder="Ingrese el número de tarjeta profesional">
                    </div>
                    <div class="form-group">
                        <label for="professional_card_issue_date">Fecha de emisión de la tarjeta
                            profesional</label>
                        <input type="date" class="form-control" id="professional_card_issue_date"
                            name="professional_card_issue_date"
                            placeholder="Ingrese la fecha de emisión de la tarjeta profesional">
                    </div>

                    <div class="form-group">
                        <label for="employee_type_id">Tipo de empleado</label>
                        <select class="form-control" id="employee_type_id" name="employee_type_id">
                            <option value="">Seleccione tipo de empleado</option>
                            @foreach ($employeeTypes as $employeeType)
                                <option value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="position_id">Cargo</label>
                        <select class="form-control" id="position_id" name="position_id">
                            <option value="">Seleccione cargo</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">
                                    {{ $position->id }}-{{ $position->professional_denomination }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="risk_type">Tipo de riesgo</label>
                        <select class="form-control" id="risk_type" name="risk_type">
                            <option value="">Seleccione tipo de riesgo</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="state">Estado</label>
                        <select class="form-control" id="state" name="state">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Registrar empleado</button> 
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
