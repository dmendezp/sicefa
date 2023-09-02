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
            const confirmBeneficiariesBtn = document.getElementById('confirmBeneficiariesBtn');
            
            confirmBeneficiariesBtn.addEventListener('click', function() {
                // Lógica para marcar a los seleccionados como Beneficiarios
                const selectedRows = document.querySelectorAll('.selected-postulation:checked');
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