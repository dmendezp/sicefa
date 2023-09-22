@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <!-- Checkbox "Seleccionar Todas" fuera del modal -->
            <label>
            </label>
            <form id="assignBenefitForm" action="{{ route('cefa.bienestar.postulation-management.assign-or-update-benefit') }}" method="POST">
                @csrf
                <select id="benefit-select" class="form-control" name="benefit_id">
                    <option value="">Selecciona un beneficio</option>
                    @foreach($benefits as $benefit)
                        <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-sm btn-primary" id="assign-benefit-btn">
                    Asignar Beneficio
                </button>
                <!-- Campos ocultos para el estado y el mensaje predeterminados para las postulaciones -->
                <input type="hidden" name="state" value="Beneficiado">
                <input type="hidden" name="message" value="Felicidades, has sido aceptado para recibir el beneficio">
                <!-- Campo oculto para las postulaciones seleccionadas (en formato JSON) -->
                <input type="hidden" id="selectedPostulations" name="selectedPostulations" value="{{ json_encode($selectedPostulations) }}">
                <!-- Campo oculto para las postulaciones no seleccionadas (en formato JSON) -->
                <input type="hidden" id="unselectedPostulations" name="unselectedPostulations" value="{{ json_encode($unselectedPostulations) }}">
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
            <form id="mark-beneficiaries-form" action="{{ route('cefa.bienestar.postulation-management.mark-as-beneficiaries') }}" method="POST">
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
                <form id="benefit-assignment-form" action="{{ route('cefa.bienestar.postulation-management.assign-or-update-benefit') }}" method="POST">
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
                    <form action="{{ route('cefa.bienestar.postulation-management.update-score', ['id' => $postulation->id]) }}"
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
                    <form action="{{ route('cefa.bienestar.postulation-management.update-state', ['id' => $postulation->id]) }}"
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
    const assignBenefitButton = document.getElementById('assign-benefit-btn');

    assignBenefitButton.addEventListener('click', function () {
        const selectedBenefitId = document.getElementById('benefit-select').value;

        // Recopila todas las checkboxes seleccionadas
        const selectedPostulations = [];
        const checkboxes = document.querySelectorAll('.select-postulations:checked');
        checkboxes.forEach(function (checkbox) {
            selectedPostulations.push(checkbox.value);
        });

        if (selectedPostulations.length === 0) {
            alert('Por favor, selecciona al menos una postulación.');
            return;
        }

        if (!selectedBenefitId) {
            alert('Por favor, selecciona un beneficio.');
            return;
        }
        // Construir los datos a enviar al servidor para asignar beneficios a los seleccionados
        const selectedData = {
            benefit_id: selectedBenefitId,
            selectedPostulations: selectedPostulations,
            state: 'Beneficiado', // Utiliza el estado predeterminado
            message: 'Felicidades, has sido aceptado para recibir el beneficio', // Utiliza el mensaje predeterminado
        };

        // Construir los datos para actualizar las postulaciones no seleccionadas (No Beneficiados)
        const unselectedData = {
            benefit_id: selectedBenefitId,
            selectedPostulations: unselectedPostulations,
            state: 'No Beneficiado', // Establecer el estado para No Beneficiados
            message: 'No ha sido aceptado para recibir el beneficio', // Establecer el mensaje para No Beneficiados
        };

        // Enviar la solicitud al servidor para asignar beneficios a los seleccionados
        fetch('{{ route('cefa.bienestar.postulation-management.assign-or-update-benefit') }}', {
            method: 'POST',
            body: JSON.stringify(selectedData),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => {
            if (response.ok) {
                return response.json(); // Si la respuesta del servidor es exitosa, parsea la respuesta JSON
            } else {
                throw new Error('Error en la respuesta del servidor'); // Si la respuesta del servidor no es exitosa, lanza un error
            }
        })
        .then(data => {
            // Manejar la respuesta del servidor para las postulaciones seleccionadas aquí
            // Por ejemplo, mostrar un mensaje de éxito
            alert('Beneficios asignados con éxito.');
        })
        .catch(error => {
            console.error('Error:', error);
            // Manejar el error, por ejemplo, mostrar un mensaje de error al usuario
            alert('Se produjo un error al asignar beneficios.');
        });

        // Enviar la solicitud al servidor para actualizar las postulaciones no seleccionadas (No Beneficiados)
        fetch('{{ route('cefa.bienestar.postulation-management.assign-or-update-benefit') }}', {
            method: 'POST',
            body: JSON.stringify(unselectedData),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor para las postulaciones no seleccionadas aquí
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>



</div>
@endsection