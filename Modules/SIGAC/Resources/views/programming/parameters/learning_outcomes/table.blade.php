<div class="table-responsive">
    <table id="learning_customes" class="display table table-striped">
        <thead>
            <tr>
                <th class="text-center">Competencia</th>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Horas</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($learning_outcomes as $competencieName => $learning_outcome)
                @foreach($learning_outcome as $l)
                <tr>
                    <!-- Mostrar la competencia solo en la primera fila -->
                    @if ($loop->first)
                    <td rowspan="{{ count($learning_outcome) }}" class="text-center">{{ $competencieName }}</td>
                    @endif
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $l->name }}</td>
                    <td class="text-center">{{ $l->hour }}</td>
                    <td class="text-center col-1">
                        <div class="opts">
                            <a data-bs-toggle="modal" data-bs-target="#editResult{{$l->id}}">
                                <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Resultado de Aprendizaje">
                                    <i class="fas fa-edit"></i>
                                </b>
                            </a>
                            <a class="delete-learning" data-learning-id="{{ $l->id }}">
                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Resultado de Aprendizaje">
                                    <i class="fas fa-trash-alt"></i>
                                </b>
                            </a>
                        </div>
                    </td>
                    @include('sigac::programming.parameters.learning_outcomes.edit')
                    <form id="delete-learning-form-{{ $l->id }}"
                        action="{{ route('sigac.academic_coordination.learning_outcome.destroy', ['id' => $l->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@include('sigac::programming.parameters.learning_outcomes.create')



<script>
    $(document).ready(function() {
    // Esperar a que la página se haya cargado completamente
    $(window).on('load', function() {
        // Inicialización de DataTables
        $('#learning_customes').DataTable({
            // Deshabilitar ordenación y paginación
            ordering: false,
            paging: false,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json" // Agregar soporte de idioma en español
            }
        });

        // Evento para eliminar un registro
        $('.delete-learning').on('click', function(event) {
            var learning_id = $(this).data('learning-id');
            console.log(learning_id); // Valor del ID
            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede revertir',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-learning-form-' + learning_id).submit();
                }
            });
        });
    });
});

</script>