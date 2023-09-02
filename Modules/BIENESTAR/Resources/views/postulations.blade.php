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
                                    <!-- Aquí van las acciones de la fila -->
                                </td>
                                <td>
                                    <input type="checkbox" data-post-id="{{ $postulation->id }}" class="selected-postulation">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button id="mark-beneficiaries-btn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirmationModal">Marcar Seleccionados como Beneficiarios</button>

                <button id="rejectApplicantsBtn" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#rejectionModal">Rechazar Aprendices</button>

                <!-- Modal -->

                <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-labelledby="rejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionModalLabel">Rechazar Aprendices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas rechazar a los aprendices no seleccionados?</p>
                <textarea id="rejectionMessage" class="form-control" placeholder="Escribe el mensaje de rechazo"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="confirmRejectionBtn" type="button" class="btn btn-danger">Confirmar Rechazo</button>
            </div>
        </div>
    </div>
</div>


                <!-- Modal -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirmar Acción</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas marcar a los seleccionados como Beneficiarios?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button id="confirmBeneficiariesBtn" type="button" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const confirmRejectionBtn = document.getElementById('confirmRejectionBtn');

    confirmRejectionBtn.addEventListener('click', function() {
        const rejectionMessage = document.getElementById('rejectionMessage').value;
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
                    newStatus: 'No Beneficiario',
                    rejectionMessage: rejectionMessage // Agrega el mensaje de rechazo
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
        const rejectionModal = document.getElementById('rejectionModal');
        $(rejectionModal).modal('hide');
    });
});

        document.addEventListener("DOMContentLoaded", function() {
            const confirmBeneficiariesBtn = document.getElementById('confirmBeneficiariesBtn');
            
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