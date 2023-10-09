@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <!-- Checkbox "Seleccionar Todas" fuera del modal -->
            <label>
                <!-- Agregar un botón "Seleccionar Todas" -->
                <input type="checkbox" id="select-all-checkbox"> Seleccionar Todas
            </label>

            
            
            <form id="update-benefit-status-form" action="{{ route('cefa.bienestar.postulation-management.update-benefits') }}" method="POST">
                @csrf
            <table id="benefitsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Apprentice Name</th>
                        <th>Convocation</th>
                        <th>Type of Benefit</th>
                        <th>Acciones</th>
                        <th>Seleccionar</th> <!-- Agregamos una columna para los checkboxes -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($postulations as $postulation)
                    <input type="hidden" name="postulation_ids[]" value="{{ $postulation->id }}">
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $postulation->apprentice->person->full_name }}</td>
                        <td>{{ $postulation->convocation->name }}</td>
                        <td>{{ $postulation->typeOfBenefit->name }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#modal_{{ $postulation->id }}">
                                Ver Detalles
                            </button>
                        </td>
                        <td>
                            <!-- Agregamos el checkbox con los atributos necesarios -->
                            <input type="checkbox" name="selected_postulations[]" value="{{ $postulation->id }}" {{-- class="select-postulations" data-postulations-id="{{ $postulation->id }}" data-learner-name="{{ $postulation->learner ? $postulation->learner->name : '' }}" --}}>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                {{-- <input type="hidden" id="selected-beneficiado" name="selectedBeneficiado" value="">
                <input type="hidden" id="selected-no-beneficiado" name="selectedNoBeneficiado" value=""> --}}
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

            <div id="response-message" style="display: none;">
                <p>Estado actualizado:</p>
                <p>Beneficiado: <span id="beneficiado-count">0</span></p>
                <p>No Beneficiado: <span id="no-beneficiado-count">0</span></p>
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
                <p><strong>Type of Benefit:</strong> {{ $postulation->typeOfBenefit->name }}</p>

                <p><strong>Questions and Answers:</strong></p>
                <ul>
                    @foreach($questions as $question)
                    <li>
                        <strong>Question:</strong> {{ $question->question }}<br>
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
                        method="PUT">
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

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
    
        selectAllCheckbox.addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('.select-postulations');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    });
    </script>
    <script>
        // Script JavaScript para manejar los checkboxes y enviar la solicitud AJAX
$(document).ready(function () {
    const csrfToken = '{{ csrf_token() }}';
    const postulationStatus = {};

    // Al hacer clic en un checkbox
    $('input[type="checkbox"]').on('change', function () {
        const checkboxName = $(this).attr('name');
        const [_, postulationId] = checkboxName.split('_');
        const isChecked = $(this).is(':checked');

        postulationStatus[postulationId] = isChecked;
    });

    // Al hacer clic en el botón "Guardar"
    $('#guardarBtn').on('click', function () {
        const dataToSend = [];
        for (const postulationId in postulationStatus) {
            if (postulationStatus.hasOwnProperty(postulationId)) {
                const isChecked = postulationStatus[postulationId];
                dataToSend.push({
                    postulation_id: postulationId,
                    state: isChecked ? 'Beneficiado' : 'No Beneficiado',
                    message: isChecked ? 'Felicidades' : 'Mala suerte'
                });
            }
        }

        // Enviar la solicitud AJAX al servidor
        $.ajax({
            url: '{{ route('cefa.bienestar.postulation-management.update-benefits') }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                postulations: dataToSend
            },
            success: function (response) {
                console.log(response);
                // Actualizar la vista según sea necesario
            },
            error: function (error) {
                console.error(error);
                // Manejar errores si es necesario
            }
        });
    });
});

        </script>
        <script>
            $(document).ready(function () {
                $('#assign-benefits-button').click(function () {
                    $.ajax({
                        url: "{{ route('cefa.bienestar.postulation-management.assign-benefits') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Procesa la respuesta del servidor, por ejemplo, muestra un mensaje de éxito
                            console.log(response.message);
                        },
                        error: function (error) {
                            // Maneja errores, por ejemplo, muestra un mensaje de error
                            console.error(error);
                        }
                    });
                });
            });
            </script>
    @endsection
