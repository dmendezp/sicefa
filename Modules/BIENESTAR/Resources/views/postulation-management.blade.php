@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>Postulaciones con Información de Aprendices</h1>
    <div class="container">
        <div style="border: 1px solid #707070; padding: 20px; background-color: white; border-radius: 10px;">
            <form id="update-benefit-status-form" action="{{ route('cefa.bienestar.postulation-management.update-benefits') }}" method="POST">
                @csrf
                <table id="benefitsTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Seleccionar</th> 
                            <th>Nombre del Aprendiz</th>
                            <th>Convocatoria</th>
                            <th>Tipo de Beneficiario</th>
                            <th>Beneficio al que se Postula</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($postulations as $postulation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <!-- Agrega el checkbox con el atributo value igual al postulation_id -->
                                <input type="checkbox" class="benefit-checkbox" name="selected_postulations[]" value="{{ $postulation->id }}">
                            </td>
                            <td>{{ $postulation->apprentice->person->full_name }}</td>
                            <td>{{ $postulation->convocation->name }} - {{ $postulation->convocation->description }}</td>
                            <td>{{ $postulation->typeOfBenefit->name }}</td>
                            <td>
                                @php
                                    $beneficioAlQueSePostula = null;
                                    $pregunta = $postulation->answers->where('question.question', 'Apoyo al que se postula')->first();
                                    if ($pregunta) {
                                        $beneficioAlQueSePostula = $pregunta->answer;
                                    }
                                @endphp
                                @if ($beneficioAlQueSePostula)
                                    {{ $beneficioAlQueSePostula }}
                                @else
                                    No disponible
                                @endif
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
                <button type="submit" id="guardarBtn" class="btn btn-primary">Guardar Registros</button>
                
                <button type="button" id="toggle-all-checkboxes" class="btn btn-secondary">Alternar Todos los Checkboxes</button>
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
                    <p><strong>Convocation:</strong> {{ $postulation->convocation->name }} - {{ $postulation->convocation->description }}</p>
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
            $(document).on('click', '#guardarBtn', function () {
        console.log('Botón de guardar clicado.');
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

                console.log('Datos a enviar:', dataToSend); // Agrega esto para verificar los datos antes de enviar la solicitud AJAX.

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
                        console.log('Respuesta exitosa:');
                        console.log(response);
                    },
                    error: function (error) {
                        console.error('Error en la solicitud:');
                        console.error(error);
                    }
                });
            });

            // Capturar evento de cambio en los checkboxes en esta sección
            $('input[type="checkbox"]').on('change', function() {
                const checkboxName = $(this).attr('name');
                const [_, benefitId, typeId] = checkboxName.split('_');
                const isChecked = $(this).is(':checked');

                // Realizar una solicitud AJAX para actualizar el estado de los registros
                $.ajax({
                    url: '{{ route('cefa.bienestar.benefitstypeofbenefits.updateInline') }}',
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        benefit_id: benefitId,
                        type_of_benefit_id: typeId,
                        checked: isChecked
                    },
                    success: function(response) {
                        console.log('Respuesta exitosa:', response);
                        // Aquí puedes realizar cualquier acción adicional después de la actualización
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Agrega un escuchador de clic al botón "Alternar Todos los Checkboxes"
        const toggleAllCheckboxesButton = document.getElementById('toggle-all-checkboxes');
        toggleAllCheckboxesButton.addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.benefit-checkbox');
            checkboxes.forEach(function (checkbox) {
                // Cambia el estado de cada checkbox
                checkbox.checked = !checkbox.checked;
            });
        });
    });
</script>




    @endsection
