@extends('gth::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Reportes de contratos</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearModal">
                            Crear Contrato
                        </button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tipo Documento</th>
                                    <th>Número Documento</th>
                                    <th>Nombre Completo</th>
                                    <th style="width: 200px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractor as $contract)
                                    <tr>
                                        <td>{{ $contract->person->id }}</td>
                                        <td>{{ $contract->person->document_type }}</td>
                                        <td>{{ $contract->person->document_number }}</td>
                                        <td>{{ $contract->person->first_name }} {{ $contract->person->first_last_name }}
                                            {{ $contract->person->second_last_name }}</td>
                                            <form action="{{ route('gth.contractor.delete', $contract->id) }}"
                                                method="POST" class="btnEliminar" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                        <td>
                                            <a href="#" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                data-bs-target="#editarModal" data-number="{{ $contract->contract_number }}"
                                                data-contract-year="{{ $contract->contract_year }}"
                                                data-contract-start-date="{{ $contract->contract_start_date }}"
                                                data-contract-end-date="{{ $contract->contract_end_date }}"
                                                data-total-contract-value="{{ $contract->total_contract_value }}"
                                                data-contractor-type-id="{{ $contract->contractor_type_id }}"
                                                data-contract-object="{{ $contract->contract_object }}"
                                                data-contract-obligations="{{ $contract->contract_obligations }}"
                                                data-amount-hours="{{ $contract->amount_hours }}"
                                                data-assignment-value="{{ $contract->assigment_value }}"
                                                data-sesion="{{ $contract->sesion }}"
                                                data-sesion-date="{{ $contract->sesion_date }}"
                                                data-employee-type-id="{{ $contract->employee_type_id }}"
                                                data-SIIF-code="{{ $contract->SIIF_code }}"
                                                data-insurer-entity-id="{{ $contract->insurer_entity_id }}"
                                                data-policy-number="{{ $contract->policy_number }}"
                                                data-policy-issue-date="{{ $contract->policy_issue_date }}"
                                                data-policy-effective-date="{{ $contract->policy_effective_date }}"
                                                data-policy-expiration-date="{{ $contract->policy_expiration_date }}"
                                                data-risk-type="{{ $contract->risk_type }}"
                                                data-state="{{ $contract->state }}">Editar</a>
                                                <button type="submit" class="btn btn-danger"
                                                    data-id="{{ $contract->id }}">Eliminar</button>
                                        </td>
                                    </form>
                                    </tr>
                                @endforeach
                                <!-- Repite este bloque para cada tipo de contrato -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('gth::contracts.modal_edit')
@endsection

@section('js')
    <script>
        'use strict';
        // Selecciona todos los formularios con la clase "formEliminar"
        var forms = document.querySelectorAll('.btnEliminar');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    console.log('Formulario enviado'); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "¿Estas seguro que deseas eliminar?",
                        text: "Este proceso es irrevesible.",
                        icon: 'Advertencia',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Si, Elimínalo",
                        cancelButtonText: "Cancelar" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    });
                });
            });
    </script>

    <script>
        'use strict';
        var Guardar = document.getElementById('Guardar');

        Guardar.addEventListener('click', function() {
            // Simulamos una operación de guardado exitosa (puedes reemplazar esto con tu lógica real de guardado)
            // Supongamos que aquí tienes tu lógica para guardar datos en el servidor

            // Luego de que se haya completado la operación de guardado, muestra el SweetAlert
            Swal.fire({
                title: 'Guardado exitoso',
                text: 'Los datos se han guardado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        });
        
    </script>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Exito!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
        });
    </script>
@endif
    
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editar-btn').click(function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');

                $('#editId').val(id);
                $('#editName').val(nombre);

                // Obtener la ruta de actualización del formulario de edición
                var updateRoute = '{{ route('gth.contractor.update', ['id' => ':id']) }}'.replace(
                    ':id', id);

                // Asignar la ruta de actualización al formulario de edición
                $('#editForm').attr('action', updateRoute);
            });

            $('#editForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'), // Usar la ruta de acción del formulario
                    method: 'PATCH',
                    data: formData,
                    success: function(response) {
                        // Actualizar la página después de un breve retraso
                        setTimeout(function() {
                            location.reload();
                        }, 1000); // Espera 1 segundo (1000 milisegundos) antes de recargar

                        // Cerrar el modal
                        var modal = new bootstrap.Modal(document.getElementById('editarModal'));
                        modal.hide();
                    }
                });
            });
        });
    </script>
@endpush
