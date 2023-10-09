@extends('hdc::layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>Registros guardados</strong></h2>
            </div>

            <div class="card-body">
                <a href="{{ route('cefa.hdc.formulario') }}" class="btn btn-success mb-2">
                    <i class="fa-solid fa-plus"></i>
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Unidad Productiva</th>
                                <th>Actividades</th>
                                <th>Labor</th> <!-- Nueva columna -->
                                <th>Aspecto Ambiental</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $globalIteration = 1; @endphp
                            @foreach ($formattedData as $unitData)
                                @foreach ($unitData as $activityData)
                                    @foreach ($activityData['aspect_data'] as $index => $aspectData)
                                        <tr>
                                            @if ($index === 0)
                                                <td rowspan="{{ count($activityData['aspect_data']) }}" class="center-text">
                                                    {{ $globalIteration++ }}
                                                </td>
                                                <td rowspan="{{ count($activityData['aspect_data']) }}" class="center-text">
                                                    {{ $activityData['unit_name'] }}
                                                </td>
                                                <td rowspan="{{ count($activityData['aspect_data']) }}" class="center-text">
                                                    {{ $activityData['activity_name'] }}
                                                </td>
                                            @endif

                                            @if ($index === 0)
                                                <td rowspan="{{ count($activityData['aspect_data']) }}" class="center-text">
                                                    {{ $aspectData['labor_planning'] }}
                                                </td>
                                            @endif

                                            <td class="center-text">{{ $aspectData['aspect_name'] }}</td>
                                            <td class="center-text">{{ $aspectdData['amount'] }}</td>
                                            <td>  {{-- Boton Eliminar --}}
                                                <form action="{{ route('cefa.hdc.delete', ['id' => $aspectData['id']]) }}" method="POST" class="formEliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger ml-2 btnEliminar" type="submit" data-id="{{ $aspectData['id']}}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <style>
        .center-text {
            text-align: center;
            vertical-align: middle !important;
            /* Importante para que sobrescriba cualquier otro estilo vertical-align */
        }
    </style>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForms = document.querySelectorAll('.formEliminar');

            deleteForms.forEach((form) => {
                const deleteButton = form.querySelector('.btnEliminar');
                const activityId = deleteButton.getAttribute('data-id');

                deleteButton.addEventListener('click', () => {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Aquí puedes enviar el formulario o realizar la acción de eliminación directamente
                            form.submit();
                            // O puedes hacer una solicitud AJAX para eliminar el elemento
                            // fetch(`/cefa/hdc/delete/${activityId}`, { method: 'DELETE' });
                        } else {
                            Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                        }
                    });
                });
            });

            // Verificar si hay mensajes de éxito o error desde el servidor
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire('Éxito', successMessage, 'success');
            }

            if (errorMessage) {
                Swal.fire('Error', errorMessage, 'error');
            }
        });
    </script>
@endpush
