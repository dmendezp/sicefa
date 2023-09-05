@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <!-- Checkbox "Seleccionar Todas" fuera del modal -->
            <label>
                <input type="checkbox" id="select-all"> Seleccionar Todas
            </label>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Seleccionar</th>
                        <th>Apprentice Name</th>
                        <th>Convocation</th>
                        <th>Type of Benefit</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postulations as $postulation)
                    <tr>
                        <td>{{ $postulation->id }}</td>
                        <td>
                            <input type="checkbox" name="selected-postulations[]" value="{{ $postulation->id }}">
                        </td>
                        <td>{{ $postulation->apprentice->person->full_name }}</td>
                        <td>{{ $postulation->convocation->name }}</td>
                        <td>{{ $postulation->typeOfBenefit->name }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#modal_{{ $postulation->id }}">
                                Ver Detalles
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form id="mark-beneficiaries-form" action="{{ route('bienestar.postulations.mark-as-beneficiaries') }}" method="POST">
                @csrf
                <input type="hidden" id="selected-postulations" name="selected-postulations" value="">
                <button type="submit" class="btn btn-sm btn-primary">Marcar Seleccionados como Beneficiarios</button>

                <!-- Botón que abrirá el modal -->
<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">Marcar Seleccionados como No Beneficiarios</button>

<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Encabezado del modal -->
      <div class="modal-header">
        <h4 class="modal-title">Confirmar acción</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Contenido del modal -->
      <div class="modal-body">
        ¿Estás seguro de que deseas marcar a los seleccionados como "No Beneficiarios"?
        <div class="form-group">
        <p></p>
          <label for="mensaje">Mensaje Al Aprendiz No Beneficiario:</label>
          <input type="text" class="form-control" id="mensaje" placeholder="Escribe tu mensaje aquí">
        </div>
      </div>
      
      <!-- Pie del modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Confirmar</button>
      </div>
      
    </div>
  </div>
</div>

            </form>
        </div>
    </div>
</div>



@foreach($postulations as $postulation)

<!-- Modal de detalles de postulación -->
<div class="modal fade" id="modal_{{ $postulation->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel_{{ $postulation->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel_{{ $postulation->id }}">Detalles de Postulación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Apprentice Name:</strong> {{ $postulation->apprentice->person->full_name }}</p>
                <p><strong>Convocation:</strong> {{ $postulation->convocation->name }}</p>
                <p><strong>Type of Benefit:</strong> {{ $postulation->typeOfBenefit->name }}</p>

                <p><strong>Questions and Answers:</strong></p>
                <ul>
                    @foreach($questions as $question)
                    <li>
                        <strong>Question:</strong> {{ $question->name }}<br>
                        <strong>Answer:</strong>
                        @php
                        $answer = $postulation->answers->where('questions_id', $question->id)->first();
                        @endphp
                        @if ($answer)
                        {{ $answer->answer }}
                        @else
                        No answer provided
                        @endif
                    </li>
                    @endforeach
                </ul>

                <p><strong>Total Score:</strong> <span id="total-score_{{ $postulation->id }}">{{ $postulation->total_score }}</span></p>

                <div class="form-group">
                    <form action="{{ route('bienestar.postulations.update-score', ['id' => $postulation->id]) }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="new-score">Nueva Puntuación:</label>
                            <input type="number" class="form-control" name="new-score" id="new-score" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Puntuación</button>
                    </form>
                </div>
                <div class="form-group">
                    <form action="{{ route('bienestar.postulations.update-state', ['id' => $postulation->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT') <!-- Cambia a 'PUT' -->
                        <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                        <div class="form-group">
                            <label for="state">Nuevo Estado:</label>
                            <select class="form-control" name="state" id="state">
                                <option value="Beneficiado"
                                    {{ $postulation->postulationBenefits->first()->state == 'Beneficiado' ? 'selected' : '' }}>
                                    Beneficiado</option>
                                <option value="No Beneficiado"
                                    {{ $postulation->postulationBenefits->first()->state == 'No Beneficiado' ? 'selected' : '' }}>
                                    No Beneficiado</option>
                                <option value="Postulado"
                                    {{ $postulation->postulationBenefits->first()->state == 'Postulado' ? 'selected' : '' }}>
                                    Postulado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Estado</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    const assignBenefitsRoute = '{{ route('bienestar.postulations.assign-benefits') }}';
    const markAsBeneficiariesRoute = '{{ route('bienestar.postulations.mark-as-beneficiaries') }}';

    document.addEventListener("DOMContentLoaded", function () {
        const confirmBeneficiariesBtn = document.getElementById('mark-beneficiaries-btn');
        const modalForm = document.getElementById('benefit-assignment-form');

        // Agrega aquí la lógica para el checkbox "Seleccionar Todas"
        const selectAllCheckbox = document.getElementById('select-all');
        const postulationCheckboxes = document.querySelectorAll('input[name="selected-postulations[]"]');

        selectAllCheckbox.addEventListener('change', function () {
            const isChecked = selectAllCheckbox.checked;

            postulationCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        confirmBeneficiariesBtn.addEventListener('click', function () {
            // Abre el modal de asignación de beneficios
            $('#confirmationModal').modal('show');
        });

        // Agrega aquí la lógica para enviar el formulario y registrar en la tabla postulations_benefits
        modalForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(modalForm);
            const csrfToken = '{{ csrf_token() }}';

            fetch(assignBenefitsRoute, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        // Actualiza la vista con la información actualizada
                        // Cierra el modal
                        $('#confirmationModal').modal('hide');
                        // Recarga la página o actualiza la vista de manera adecuada
                        window.location.reload(); // Esto recargará la página
                    } else {
                        // Muestra un mensaje de error si es necesario
                        alert('Error al asignar beneficios: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        @foreach($postulations as $postulation)
        const totalScoreSpan_{{ $postulation->id }} = document.getElementById('total-score_{{ $postulation->id }}');
        const updateStateForm_{{ $postulation->id }} = document.getElementById('update-state-form_{{ $postulation->id }}');

        updateStateForm_{{ $postulation->id }}.addEventListener('submit', function (event) {
            event.preventDefault();
            const form = updateStateForm_{{ $postulation->id }};
            const benefitId = form.dataset.benefitId;
            const newState = form.querySelector('#state_{{ $postulation->id }}').value;

            // Realizar una solicitud AJAX para actualizar el estado
            fetch(updateStateRoute.replace('benefitIdPlaceholder', benefitId), {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        state: newState
                    }),
                })

                .then(response => response.json())
                .then(data => {
                    if (data.state) {
                        // Actualiza la vista con el nuevo estado (puedes personalizar esto)
                        alert('Estado actualizado con éxito: ' + data.state);
                    } else {
                        // Muestra un mensaje de error si es necesario
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        @endforeach

        // Agrega la lógica para marcar como beneficiarios
        const markBeneficiariesForm = document.getElementById('mark-beneficiaries-form');
        markBeneficiariesForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const selectedPostulations = [...postulationCheckboxes]
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedPostulations.length === 0) {
                alert('Por favor, selecciona al menos una postulación.');
                return;
            }

            // Establece las selecciones como valor del campo oculto
            document.getElementById('selected-postulations').value = JSON.stringify(selectedPostulations);

            // Envía el formulario
            markBeneficiariesForm.submit();
        });
    });
</script>

@endsection
