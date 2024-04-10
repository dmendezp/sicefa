<div>
    <div class="table-responsive">
        <table id="quarterlies" class="table">
            <thead>
                <tr>
                    <th class="text-center">Competencia</th>
                    <th class="text-center">Resultado de Aprendizaje</th>
                    <th class="text-center">
                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.create') }}">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @for($trimestreNumber = 1; $trimestreNumber <= $courseNumber; $trimestreNumber++)
                    <tr>
                        <td colspan="3" class="text-center">Trimestre {{ $trimestreNumber }}</td>
                    </tr>
                    @foreach($quarterlies as $quarterly)
                        @if($quarterly->quarter_number == $trimestreNumber)
                            <tr>
                                <td class="text-center">{{ $quarterly->competency }}</td>
                                <td class="text-center">{{ $quarterly->learning_outcome->name }}</td>
                                <td class="text-center">
                                    <div class="opts">
                                        <a href="{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.edit', ['id' => $quarterly->id]) }}">
                                            <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Competencia">
                                                <i class="fas fa-edit"></i>
                                            </b>
                                        </a>
                                        <a class="delete-competence" data-competence-id="{{ $quarterly->id }}">
                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </b>
                                        </a>
                                    </div>
                                </td>
                                <form id="delete-competence-form-{{ $quarterly->id }}"
                                      action="{{ route('sigac.academic_coordination.competences.destroy', ['id' => $quarterly->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @endif
                    @endforeach
                @endfor
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-competence').on('click', function(event) {
            var competence_id = $(this).data('competence-id');
            console.log(competence_id); // Your value from
            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estas seguro?',
                text: 'Esta accion no se puede remover',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-competence-form-' + competence_id).submit();
                }
            });
        });
    });
</script>
