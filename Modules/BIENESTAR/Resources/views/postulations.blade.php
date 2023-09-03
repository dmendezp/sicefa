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
                            <form id="benefit-assignment-form" action="{{ route('bienestar.postulations.assign-benefits') }}" method="POST">
                                @csrf
                                <!-- Campo para seleccionar múltiples postulaciones -->
                                <div class="form-group">
                                    <label for="selected-postulations">Seleccionar Postulaciones:</label>
                                    <div class="postulations-container">
                                        @foreach($postulations as $postulation)
                                            <div class="postulation-item">
                                                <input type="checkbox" name="selected-postulations[]"
                                                    value="{{ $postulation->id }}">
                                                {{ $postulation->apprentice->person->full_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Campo para seleccionar beneficio -->
                                <div class="form-group">
                                    <label for="benefit_id">Beneficio:</label>
                                    <select class="form-control" name="benefit_id" id="benefit_id">
                                        @foreach($benefits as $benefit)
                                        <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="form-group">
                                    <label for="state">Estado:</label>
                                    <input type="text" class="form-control" name="state" id="state">
                                </div>
                            
                                <div class="form-group">
                                    <label for="message">Mensaje:</label>
                                    <textarea class="form-control" name="message" id="message"></textarea>
                                </div>
                            
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
                    <form action="{{ route('bienestar.postulations.update-score', ['id' => $postulation->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="new-score">Nueva Puntuación:</label>
                            <input type="number" class="form-control" name="new-score" id="new-score" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Puntuación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    const assignBenefitsRoute = '{{ route('bienestar.postulations.assign-benefits') }}';

    document.addEventListener("DOMContentLoaded", function () {
        const confirmBeneficiariesBtn = document.getElementById('mark-beneficiaries-btn');
        const modalForm = document.getElementById('benefit-assignment-form');

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
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>




@endsection