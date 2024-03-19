@if (isset($contractor))
    {!! Form::hidden('id', $contractor->id) !!}
@endif
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Detalles del Contratista</b>
        </h5>
    </div>
        <div class="modal-body px-4 pt-0">
            <h4>Contrato - {{ $contractor->person->fullname }}</h4>
                <ul class="mt-3">
                    <li>
                        <p><b>Numero de contrato: </b> {{ $contractor->contract_number }}</p>
                    </li>
                    <li>
                        <p><b>Supervisor: </b> {{ $contractor->person->fullname }}</p>
                    </li>
                    <li>
                        <p><b>Fecha de inicio: </b> {{ $contractor->contract_start_date }}</p>
                    </li>
                    <li>
                        <p><b>Fecha de finalización: </b> {{ $contractor->contract_end_date }}</p>
                    </li>
                    <li>
                        <p><b>Tipo de Contrato:</b> {{ $contractor->contractor_type->name }}</p>
                    </li>
                    <li>
                        <p><b>Horas:</b> {{ $contractor->amount_hours }}</p>
                    </li>
                    <li>
                        <p><b>Codigo SIIF:</b> {{ $contractor->SIIF_code }}</p>
                    </li>
                    <li>
                        <p><b>Tipo de Empleado:</b> {{ $contractor->employee_type->name }}</p>
                    </li>
                    <li>
                        <p><b>Entidad aseguradora:</b> {{ $contractor->insurer_entity->name }}</p>
                    </li>
                    <li>
                        <p><b>Valor:</b> {{ $contractor->total_contract_value }}</p>
                    </li>
                    <li>
                        <p><b>Tipo de riesgo:</b> {{ $contractor->risk_type }}</p>
                    </li>
                    <li>
                        <p><b>Numero de poliza:</b> {{ $contractor->policy_number }}</p>
                    </li>
                    <li>
                        <p><b>Fecha Emisión de Póliza:</b> {{ $contractor->policy_issue_date }}</p>
                    </li>
                    <li>
                        <p><b>Fecha Aprobación de Póliza:</b> {{ $contractor->policy_approval_date }}</p>
                    </li>
                    <li>
                        <p><b>Fecha Vigencia de Póliza:</b> {{ $contractor->policy_effective_date }}</p>
                    </li>
                    <li>
                        <p><b>Fecha Vencimiento de Póliza:</b> {{ $contractor->policy_expiration_date }}</p>
                    </li>
                    <li>
                        <p><b>Objeto:</b> {{ $contractor->contract_object }}</p>
                    </li>
                    <li>
                        <p><b>Obligaciones:</b> {{ $contractor->contract_obligations }}</p>
                    </li>
                    <li>
                        <p><b>Estado:</b> {{ $contractor->state }}</p>
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
