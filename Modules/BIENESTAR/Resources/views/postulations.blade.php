@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <!-- Checkbox "Seleccionar Todas" fuera del modal -->
            <label>
            </label>

            <table id="benefitsTable" class="table table-bordered table-striped">
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
                        <td><input type="checkbox" name="selected-postulations[]" class="select-postulations" data-postulations-id="{{ $postulation->id }}" data-learner-name="{{ $postulation->learner ? $postulation->learner->name : '' }}" value="{{ $postulation->id }}"></td>
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
                <!-- Botón que abrirá el modal de confirmación -->
                <button type="button" class="btn btn-sm btn-primary" id="mark-beneficiaries-btn" data-toggle="modal" data-target="#confirmationModal">
                    Marcar Seleccionados como Beneficiarios
                </button>
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">Marcar Seleccionados como No Beneficiado</button>
                <!-- Modal de confirmación -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirmar acción</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas marcar a los seleccionados como "Beneficiarios"?</p>
                                <!-- Lista de aprendices seleccionados -->
                                <ul id="selected-learners-list">
                                    <!-- Aquí se mostrarán los nombres de los aprendices seleccionados -->
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <!-- Formulario que enviará la asignación de beneficios -->
                                <form id="benefit-assignment-form" action="{{ route('bienestar.postulations.assign-benefits') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="selected-postulations" name="selected-postulations" value="">
                                    <input type="hidden" id="benefitId" name="benefit_id" value="1"> <!-- Cambia el valor según tu lógica -->
                                    <input type="hidden" id="state" name="state" value="Beneficiado"> <!-- Cambia el valor según tu lógica -->
                                    <input type="hidden" id="message" name="message" value="Felicidades, Has sido aceptado al Beneficio solicitado"> <!-- Cambia el mensaje según tu lógica -->
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </form>
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
    document.addEventListener("DOMContentLoaded", function () {
        const markAsBeneficiariesRoute = '{{ route('bienestar.postulations.mark-as-beneficiaries') }}';
        const assignBenefitsRoute = '{{ route('bienestar.postulations.assign-benefits') }}';
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

        console.log(postulationCheckboxes); // Añadido el console.log aquí

        confirmBeneficiariesBtn.addEventListener('click', function () {
            // Abre el modal de confirmación
            const selectedPostulations = [...postulationCheckboxes]
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedPostulations.length === 0) {
                alert('Por favor, selecciona al menos una postulación.');
                return;
            }

            // Establece las selecciones como valor del campo oculto
            document.getElementById('selected-postulations').value = JSON.stringify(selectedPostulations);

            // Envia una solicitud al servidor para marcar como beneficiarios
            fetch(markAsBeneficiariesRoute, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ selectedPostulations })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualiza la vista con la información actualizada
                    // Cierra el modal
                    $('#confirmationModal').modal('hide');
                    // Recarga la página o actualiza la vista de manera adecuada
                    window.location.reload(); // Esto recargará la página
                } else {
                    // Muestra un mensaje de error si es necesario
                    alert('Error al marcar como beneficiarios: ' + data.error);
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
        const markBeneficiariesForm = document.getElementById('benefit-assignment-form');
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

        function updateSelectedLearnersList() {
            const selectedPostulationCheckboxes = [...postulationCheckboxes]
                .filter(checkbox => checkbox.checked);

            const selectedLearnersList = document.getElementById('selected-learners-list');
            selectedLearnersList.innerHTML = '';

            selectedPostulationCheckboxes.forEach(checkbox => {
                const learnerName = checkbox.dataset.learnerName; // Asegúrate de tener este atributo en tus checkboxes
                const listItem = document.createElement('li');
                listItem.textContent = learnerName;
                selectedLearnersList.appendChild(listItem);
            });

            // Mostrar el modal después de actualizar la lista
            $('#confirmationModal').modal('show');
        }

        // Agrega un listener para actualizar la lista cuando cambie la selección de postulaciones
        postulationCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedLearnersList);
        });
        confirmBeneficiariesBtn.addEventListener('click', function () {
    // Abre el modal de asignación de beneficios
    $('#confirmationModal').modal('show');
    updateSelectedLearnersList(); // Llama a esta función para mostrar los seleccionados
});

// ...

// Agrega una función para actualizar la lista de aprendices seleccionados
function updateSelectedLearnersList() {
    const selectedPostulationCheckboxes = [...postulationCheckboxes]
        .filter(checkbox => checkbox.checked);

    const selectedLearnersList = document.getElementById('selected-learners-list');
    selectedLearnersList.innerHTML = '';

    selectedPostulationCheckboxes.forEach(checkbox => {
        const learnerName = checkbox.dataset.learnerName; // Asegúrate de tener este atributo en tus checkboxes
        const listItem = document.createElement('li');
        listItem.textContent = learnerName;
        selectedLearnersList.appendChild(listItem);
    });
}

// Agrega un listener para actualizar la lista cuando cambie la selección de postulaciones
postulationCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedLearnersList);
});
    });
</script>


@endsection
