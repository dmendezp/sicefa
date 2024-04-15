@if (isset($employee))
    {!! Form::hidden('id', $employee->id) !!}
@endif
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Detalles del Funcionario</b>
        </h5>
    </div>
        <div class="modal-body px-4 pt-0">
            <h4>Contrato - {{ $employee->person->fullname }}</h4>
                <ul class="mt-3">
                    <li>
                        <p><b>Numero de contrato: </b> {{ $employee->contract_number }}</p>
                    </li>
                    <li>
                        <p><b>Fecha: </b> {{ $employee->contract_date }}</p>
                    </li>
                    <li>
                        <p><b>Número tarjeta profesional: </b> {{ $employee->professional_card_number }}</p>
                    </li>
                    <li>
                        <p><b>Fecha emisión de tarjeta profesional :</b> {{ $employee->professional_card_issue_date }}</p>
                    </li>
                    <li>
                        <p><b>Tipo de Empleado:</b> {{ $employee->employee_type->name }}</p>
                    </li>
                    <li>
                        <p><b>Grado:</b> {{ $employee->position->professional_denomination }} - {{ $employee->position->grade }}</p>
                    </li>
                    <li>
                        <p><b>Tipo de riesgo:</b> {{ $employee->risk_type }}</p>
                    </li>
                    <li>
                        <p><b>state:</b> {{ $employee->state }}</p>
                    </li>
                </ul>
        </div>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
