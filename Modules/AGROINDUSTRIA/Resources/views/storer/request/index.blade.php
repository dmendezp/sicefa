@extends('agroindustria::layouts.master')
@section('content')

<div class="request" style="margin: 40px">
    <h1>{{trans('agroindustria::request.requestInstructor')}}</h1>
    <table id="request" class="hover" style="width: 100%;">
        <thead>
            <tr>
                <th>{{trans('agroindustria::request.date')}}</th>
                <th>{{trans('agroindustria::request.element')}}</th>
                <th>{{trans('agroindustria::request.amount')}}</th>
                <th>{{trans('agroindustria::request.applicant')}}</th>
                <th>{{trans('agroindustria::request.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $r)
            <tr data-created-at="{{$r->created_at}}">
                <td>{{$r->planning_date}}</td>
                <td> 
                    @php
                        $elementQuantities = []; // Array para almacenar la cantidad total por elemento
                        $elementQuantitiesAbbreviations = [];
                    @endphp
                
                    @foreach ($r->consumables as $c)
                        @php
                            $elementName = $c->inventory->element->name;
                            $elementQuantity = $c->amount / $c->inventory->element->measurement_unit->conversion_factor;;
                            $elementAbbreviation = $c->inventory->element->measurement_unit->abbreviation;

                            // Sumar la cantidad al elemento correspondiente en el array
                            $elementQuantities[$elementName] = isset($elementQuantities[$elementName])
                                ? $elementQuantities[$elementName] + $elementQuantity
                                : $elementQuantity;
                            
                            $elementQuantitiesAbbreviations[$elementName] = $elementAbbreviation;
                        @endphp
                    @endforeach
                
                    @foreach ($elementQuantities as $elementName => $totalQuantity)
                        {{$elementName}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($elementQuantities as $elementName => $totalQuantity)
                    {{$totalQuantity}} {{ $elementQuantitiesAbbreviations[$elementName] }}<br>
                  @endforeach
                </td>
                <td>{{$r->person->first_name . ' ' . $r->person->first_last_name . ' ' . $r->person->second_last_name}}</td>
                <td>
                    <button type="button" class="btn btn-success approve-btn" data-bs-toggle="modal"  data-bs-target="#aprobar{{$r->id}}" data-request-id="{{$r->id}}">{{trans('agroindustria::request.approve')}}</button>
                    <button type="button" class="btn btn-danger cancel-btn" data-bs-toggle="modal" data-bs-target="#cancelar{{$r->id}}" data-reject-id="{{$r->id}}">{{trans('agroindustria::request.reject')}}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@foreach ($requests as $r)
<!-- Modal aprobar solicitud -->
<div class="modal fade" id="aprobar{{$r->id}}" tabindex="-1" aria-labelledby="aprobarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="aprobarLabel">{{trans('agroindustria::request.approveRequest')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.storer.units.request.approve', ['id' => $r->id])]) !!}
            @csrf
            @method('PUT')
            <div class="form-group">
                {!! Form::label('observation', trans('agroindustria::request.observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'observation', 'style' => 'height: 0px'] ) !!}
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::request.approve'),['class' => 'btn btn-success confirm-approve', 'name' => 'aprobar', 'id' => 'btnAprobar_'.$r->id, 'data-request-id' => $r->id]) !!}
          {!! Form:: close() !!}
        </div>
      </div>
    </div>
</div>

<!-- Modal rechazar solicitud -->
<div class="modal fade" id="cancelar{{$r->id}}" tabindex="-1" aria-labelledby="cancelarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="cancelarLabel">{{trans('agroindustria::request.rejectRequest')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'post', 'url' => route('agroindustria.storer.units.request.cancelled', ['id' => $r->id])]) !!}
            @csrf
            @method('PUT')
            <div class="form-group">
                {!! Form::label('observation', trans('agroindustria::request.observations')) !!}
                {!! Form::textarea('observation', old('observation'), ['class' => 'form-control', 'id' => 'observation-cancel', 'style' => 'height: 0px'] ) !!}
                @error('observation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>         
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('agroindustria::request.yesReject'),['class' => 'btn btn-success confirm-cancel', 'name' => 'anular', 'id' => 'btnRechazar_'.$r->id, 'data-reject-id' => $r->id]) !!}
          {!! Form:: close() !!}
        </div>
      </div>
    </div>
  </div>
@endforeach
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('#request tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    rows.sort((a, b) => {
        const statusA = a.style.backgroundColor === 'green' ? 1 : 0;
        const statusB = b.style.backgroundColor === 'green' ? 1 : 0;

        // Ordenar primero las no aprobadas y luego las aprobadas
        if (statusA !== statusB) {
            return statusB - statusA;
        }

        // Si ambas son aprobadas o no aprobadas, ordenar por fecha de creación
        const dateA = new Date(a.dataset.createdAt);
        const dateB = new Date(b.dataset.createdAt);

        return dateB - dateA;
    });

    const approveButtons = document.querySelectorAll('.approve-btn');
    
    approveButtons.forEach(button => {
        const requestId = button.getAttribute('data-request-id');
        const row = button.closest('tr');
        const modalForm = document.querySelector(`#aprobar${requestId} form`);
        const btnAprobar = document.getElementById(`btnAprobar_${requestId}`);
        $(document).ready(function() {
            // Esta función se llama cada vez que se muestra el modal
            $('div.modal').on('shown.bs.modal', function() {
                var observationField = $('textarea#observation');
                updateSaveButtonState(observationField);
            });

            // Esta función se llama cada vez que se cambia el contenido del campo de observaciones
            $('textarea#observation').on('input', function() {
                updateSaveButtonState($(this));
            });

        });

        // Verificar si la solicitud ya ha sido aprobada (si hay un valor en localStorage)
        const isApproved = localStorage.getItem(`request_${requestId}_approved`);
        if (isApproved) {
            row.style.backgroundColor = 'green';
            // Cambiar el estilo de la letra al aprobar la solicitud
            row.style.color = 'white';
            row.style.fontWeight = 'bold';
            button.style.display = 'none';
            //localStorage.removeItem(`request_${requestId}_approved`);

            const cancelButton = row.querySelector('.cancel-btn');
            if (cancelButton) {
                cancelButton.style.display = 'none';
            }

        }

        function updateSaveButtonState(observationFieldId) {
            var btnAprobar = $('.confirm-approve')
            var observation = observationFieldId.val().trim();
            console.log(observation);

            if (observation === '') {
                btnAprobar.prop('disabled', true);
                btnAprobar.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
                isAnyProductExceeding = false;
                console.log('Habilitado');
                if (!isAnyProductExceeding) {
                    btnAprobar.prop('disabled', false);
                    btnAprobar.removeClass('disabled-button');
                } else {
                    btnAprobar.prop('disabled', true);
                    btnAprobar.addClass('disabled-button');
                }
            }
        }

        btnAprobar.addEventListener('click', function () {
            // Verificar nuevamente si la solicitud ya ha sido cancelada antes de enviar el formulario
            const isApproved = localStorage.getItem(`request_${requestId}_approved`);
            if (!isApproved) {
                event.preventDefault();

                // Almacenar la cancelación en localStorage después de verificar
                localStorage.setItem(`request_${requestId}_approved`, 'true');

                // Cambiar el color de la fila al rechazar la solicitud
                row.style.backgroundColor = 'green';

                // Ahora puedes enviar el formulario si es necesario
                modalForm.submit();
            }
        });
    });

    const cancelButton = document.querySelectorAll('.cancel-btn');

    cancelButton.forEach(button => {
        const requestId = button.getAttribute('data-reject-id');
        const row = button.closest('tr');
        const modalForm = document.querySelector(`#cancelar${requestId} form`);
        const btnRechazar = document.getElementById(`btnRechazar_${requestId}`);
        $(document).ready(function() {
            // Esta función se llama cada vez que se muestra el modal
            $('div.modal').on('shown.bs.modal', function() {
                var observationField = $('textarea#observation-cancel');
                updateSaveButtonStateCancel(observationField);
            });

            // Esta función se llama cada vez que se cambia el contenido del campo de observaciones
            $('textarea#observation-cancel').on('input', function() {
                updateSaveButtonStateCancel($(this));
            });

        });

        // Verificar si la solicitud ya ha sido cancelada (si hay un valor en localStorage)
        const isCancel = localStorage.getItem(`request_${requestId}_cancelled`);

        if (isCancel) {
            row.style.backgroundColor = 'red';
            // Cambiar el estilo de la letra al aprobar la solicitud
            row.style.color = 'white';
            row.style.fontWeight = 'bold';
            button.style.display = 'none';
            //localStorage.removeItem(`request_${requestId}_cancelled`);

            const approveButton = row.querySelector('.approve-btn');
            if (approveButton) {
                approveButton.style.display = 'none';
            }
        }

        function updateSaveButtonStateCancel(observationFieldId) {
            var btnCancel = $('.confirm-cancel')
            var observation = observationFieldId.val().trim();
            console.log(observation);

            if (observation === '') {
                btnCancel.prop('disabled', true);
                btnCancel.addClass('disabled-button');
                isAnyProductExceeding = true;
                console.log('Deshabilitado');
            } else {
                isAnyProductExceeding = false;
                console.log('Habilitado');
                if (!isAnyProductExceeding) {
                    btnCancel.prop('disabled', false);
                    btnCancel.removeClass('disabled-button');
                } else {
                    btnCancel.prop('disabled', true);
                    btnCancel.addClass('disabled-button');
                }
            }
        }

        // Manejar el evento de clic en el botón de rechazo
        btnRechazar.addEventListener('click', function () {
            // Verificar nuevamente si la solicitud ya ha sido cancelada antes de enviar el formulario
            const isCancel = localStorage.getItem(`request_${requestId}_cancelled`);
            if (!isCancel) {
                event.preventDefault();

                // Almacenar la cancelación en localStorage después de verificar
                localStorage.setItem(`request_${requestId}_cancelled`, 'true');

                // Cambiar el color de la fila al rechazar la solicitud
                row.style.backgroundColor = 'red';

                // Ahora puedes enviar el formulario si es necesario
                modalForm.submit();
            }
        });
    });

});
</script>
@endsection