@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <!-- Checkbox "Seleccionar Todas" fuera del modal -->
            <label>
            </label>
            <form id="assignBenefitForm" action="{{ route('cefa.bienestar.postulations.assign-or-update-benefit') }}" method="POST">
                @csrf
                <select id="benefit-select" class="form-control" name="benefit_id">
                    <option value="">Selecciona un beneficio</option>
                    @foreach($benefits as $benefit)
                        <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-primary" id="assign-benefit-btn">
                    Asignar Beneficio
                </button>
                <!-- Campos ocultos para el estado y el mensaje predeterminados -->
                <input type="hidden" name="state" value="Beneficiado">
                <input type="hidden" name="message" value="Felicidades, has sido aceptado para recibir el beneficio">
            </form>
            <form id="mark-no-beneficiaries-form" action="{{ route('cefa.bienestar.postulations.mark-as-no-beneficiaries') }}" method="POST">
                @csrf
                <input type="hidden" id="selected-postulations-no-beneficiary" name="selected-postulations" value="">
                <input type="hidden" name="benefit_id" value="{{ $benefit->id }}"> <!-- Cambia $benefit->id al valor adecuado -->
                <input type="hidden" name="state" value="No Beneficiado">
                <input type="hidden" name="message" value="Lamentamos decirle que no has sido aceptado para recibir el beneficio">
                <button type="submit" class="btn btn-sm btn-danger" id="mark-no-beneficiaries-btn">
                    Marcar Seleccionados como No Beneficiado
                </button>
            </form>
            
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
            <form id="mark-beneficiaries-form" action="{{ route('cefa.bienestar.postulations.mark-as-beneficiaries') }}" method="POST">
                @csrf
                <input type="hidden" id="selected-postulations" name="selected-postulations" value="">
                <div class="container">
                

                



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
                <p id="confirmationMessage">¿Estás seguro de que deseas marcar a los seleccionados como "Beneficiarios"?</p>
                <!-- Lista de aprendices seleccionados -->
                <ul id="selected-learners-list">
                    <!-- Aquí se mostrarán los nombres de los aprendices seleccionados -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <!-- Formulario que enviará la asignación de beneficios -->
                <form id="benefit-assignment-form" action="{{ route('cefa.bienestar.postulations.assign-benefits') }}" method="POST">
                    @csrf
                    <input type="hidden" id="selected-postulations" name="selected-postulations" value="">
                    <input type="hidden" id="benefitId" name="benefit_id" value="1"> <!-- Cambia el valor según tu lógica -->
                    <input type="hidden" id="state" name="state" value="Beneficiado"> <!-- Cambia el valor según tu lógica -->
                    <input type="hidden" id="message" name="message" value="Felicidades, Has sido aceptado al Beneficio solicitado"> <!-- Cambia el mensaje según tu lógica -->
                    <button type="submit" class="btn btn-primary" id="confirmActionBtn">Confirmar</button>
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
                    <form action="{{ route('cefa.bienestar.postulations.update-score', ['id' => $postulation->id]) }}"
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
                    <form action="{{ route('cefa.bienestar.postulations.update-state', ['id' => $postulation->id]) }}"
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
    // Define la variable markNoBeneficiariesUrl con la ruta adecuada en tu módulo BIENESTAR
    const markNoBeneficiariesUrl = '{{ route('cefa.bienestar.postulations.mark-as-no-beneficiaries') }}';

    document.addEventListener("DOMContentLoaded", function () {
        // Script para asignar beneficio
        const assignBenefitForm = document.getElementById('assignBenefitForm');

        assignBenefitForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevenir el envío predeterminado del formulario
            
            // Obtener el beneficio seleccionado
            const selectedBenefitId = document.getElementById('benefit-select').value;

            // Obtener el estado y el mensaje predeterminados desde los campos ocultos
            const state = document.querySelector('input[name="state"]').value;
            const message = document.querySelector('input[name="message"]').value;

            // Obtener las postulaciones seleccionadas
            const selectedPostulations = [...document.querySelectorAll('input[name="selected-postulations[]"]')]
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedPostulations.length === 0) {
                alert('Por favor, selecciona al menos una postulación.');
                return;
            }

            if (!selectedBenefitId) {
                alert('Por favor, selecciona un beneficio.');
                return;
            }

            // Construir los datos a enviar al servidor
            const formData = new FormData();
            formData.append('benefit_id', selectedBenefitId);
            formData.append('selectedPostulations', JSON.stringify(selectedPostulations));
            formData.append('state', state); // Utiliza el estado predeterminado
            formData.append('message', message); // Utiliza el mensaje predeterminado

            // Enviar la solicitud al servidor para asignar beneficios
            fetch('{{ route('cefa.bienestar.postulations.assign-or-update-benefit') }}', {
                method: 'POST',
                body: JSON.stringify({
                    benefit_id: selectedBenefitId,
                    selectedPostulations: selectedPostulations,
                    state: state,
                    message: message
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor aquí
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Script para marcar como "No Beneficiado"
        const markNoBeneficiariesForm = document.getElementById('mark-no-beneficiaries-form');

        markNoBeneficiariesForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevenir el envío predeterminado del formulario

            // Obtener el estado y el mensaje para "No Beneficiado"
            const state = 'No Beneficiado';
            const message = 'Lamentamos decirle que no has sido aceptado para recibir el beneficio';

            // Obtener las postulaciones seleccionadas
            const selectedPostulations = [...document.querySelectorAll('input[name="selected-postulations[]"]')]
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedPostulations.length === 0) {
                alert('Por favor, selecciona al menos una postulación.');
                return;
            }

            // Construir los datos a enviar al servidor para marcar como "No Beneficiado"
            const formData = new FormData();
            formData.append('selectedPostulations', JSON.stringify(selectedPostulations));
            formData.append('state', state);
            formData.append('message', message);

            // Enviar la solicitud al servidor para marcar como "No Beneficiado"
            fetch(markNoBeneficiariesUrl, { // Usa la variable JavaScript aquí
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor aquí
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Resto de tu código JavaScript
        // ...
    });
</script>

</div>
@endsection