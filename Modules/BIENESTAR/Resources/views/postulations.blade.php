@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Apprentice Name</th>
                        <th>Convocation</th>
                        <th>Type of Benefit</th>
                        <th>Seleccionar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postulations as $postulation)
                    <tr>
                        <td>{{ $postulation->id }}</td>
                        <td>{{ $postulation->apprentice->person->full_name }}</td>
                        <td>{{ $postulation->convocation->name }}</td>
                        <td>{{ $postulation->typesOfBenefits->name }}</td>
                        <td>
                            <input type="checkbox" class="postulation-checkbox"
                                data-postulation-id="{{ $postulation->id }}">
                        </td>
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
            <button id="mark-beneficiaries-btn" class="btn btn-sm btn-primary">Marcar Seleccionados como Beneficiarios</button>

            <!-- Modal de asignación de beneficios -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
                aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Asignar Beneficios</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="benefit-assignment-form">
                                <input type="hidden" name="selected-postulations" id="selected-postulations">
                                <!-- Campo para seleccionar benefit_id -->
                                <div class="form-group">
                                    <label for="benefit_id">Beneficio:</label>
                                    <select class="form-control" name="benefit_id" id="benefit_id">
                                        @foreach($benefits as $benefitId)
                                            <option value="{{ $benefitId }}">{{ $benefitId }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Campos para state y message -->
                                <div class="form-group">
                                    <label for="state">Estado:</label>
                                    <input type="text" class="form-control" name="state" id="state">
                                </div>
                                <div class="form-group">
                                    <label for="message">Mensaje:</label>
                                    <textarea class="form-control" name="message" id="message"></textarea>
                                </div>

                                <!-- Botón para enviar el formulario y registrar en postulations_benefits -->
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($postulations as $postulation)
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
                <p><strong>Type of Benefit:</strong> {{ $postulation->typesOfBenefits->name }}</p>

                <p><strong>Questions and Answers:</strong></p>
                <ul>
                    @foreach($postulation->convocation->convocationsQuestions as $convocationsQuestion)
                    <li>
                        <strong>Question:</strong> {{ $convocationsQuestion->question->name }}<br>
                        <strong>Answer:</strong>
                        @php
                        $answer = $postulation->answers->where('questions_id', $convocationsQuestion->question->id)->first();
                        @endphp
                        @if ($answer)
                        {{ $answer->answer }}
                        @else
                        No answer provided
                        @endif
                    </li>
                    @endforeach
                </ul>
                <p><strong>Total Score:</strong> <span
                        id="total-score_{{ $postulation->id }}">{{ $postulation->total_score }}</span></p>

                <div class="form-group">
                    <label for="new-score_{{ $postulation->id }}">Nueva Puntuación:</label>
                    <input type="number" class="form-control new-score" id="new-score_{{ $postulation->id }}"
                        name="new-score">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary update-score-btn"
                    data-post-id="{{ $postulation->id }}">Guardar Puntuación</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const confirmBeneficiariesBtn = document.getElementById('mark-beneficiaries-btn');
        const modalForm = document.getElementById('benefit-assignment-form');

        confirmBeneficiariesBtn.addEventListener('click', function() {
            // Recopila las ID de postulaciones seleccionadas
            const selectedPostulations = [];
            const checkboxes = document.querySelectorAll('.postulation-checkbox:checked');
            checkboxes.forEach(checkbox => {
                selectedPostulations.push(checkbox.getAttribute('data-postulation-id'));
            });

            // Llena el formulario en el modal con las ID de postulaciones seleccionadas
            document.getElementById('selected-postulations').value = selectedPostulations.join(',');

            // Abre el modal de asignación de beneficios
            $('#confirmationModal').modal('show');
        });

        // Agrega aquí la lógica para enviar el formulario y registrar en la tabla postulations_benefits
        modalForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(modalForm);
            const csrfToken = '{{ csrf_token() }}';

            fetch('/assign-benefits', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualiza la vista con la información actualizada
                    // Cierra el modal
                    $('#confirmationModal').modal('hide');
                } else {
                    // Muestra un mensaje de error si es necesario
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

@endsection
