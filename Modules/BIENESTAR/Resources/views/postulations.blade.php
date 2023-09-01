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
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_{{ $postulation->id }}">
                                        Ver Detalles
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button id="mark-beneficiaries-btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirmationModal">Marcar Seleccionados como Beneficiarios</button>
                
                <!-- Modal -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <!-- Modal content here -->
                </div>
            </div>
        </div>
    </div>
    
    @foreach($postulations as $postulation)
        <div class="modal fade" id="modal_{{ $postulation->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $postulation->id }}" aria-hidden="true">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const confirmBeneficiariesBtn = document.getElementById('mark-beneficiaries-btn');

            confirmBeneficiariesBtn.addEventListener('click', function() {
                // Lógica para marcar a los seleccionados como Beneficiarios
                const selectedRows = document.querySelectorAll('.selected-postulation:checked');
                const csrfToken = '{{ csrf_token() }}';

                selectedRows.forEach(row => {
                    const postId = row.getAttribute('data-post-id');

                    fetch(`/update-postulation-status/${postId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            newStatus: 'Beneficiario'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualizar la interfaz o mostrar algún mensaje de confirmación
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });

                // Cerrar el modal después de confirmar
                const confirmationModal = document.getElementById('confirmationModal');
                $(confirmationModal).modal('hide');
            });
        });
    </script>
@endsection
