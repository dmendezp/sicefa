<div>
    <div class="table-responsive">
        <table id="quarterlies" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">Número de trimestres</th>
                    <th class="text-center">Competencia</th>
                    <th class="text-center">Resultado de Aprendizaje</th>
                    <th class="text-center">
                        <a data-toggle="modal" data-target="#addquarterlie" onclick="">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($quarterlies as $q)
                <tr>
                    <td class="text-center">{{ $q->quarter_number }}</td>
                    <td class="text-center">{{ $q->learning_outcome->competencie->name }}</td>
                    <td class="text-center">{{ $q->learning_outcome->name }}</td>
                    <td class="text-center">
                        <div class="opts">
                            <a  data-bs-toggle="modal" data-bs-target="#editCompetence{{$q->id}}">
                                <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Competencia">
                                    <i class="fas fa-edit"></i>
                                </b>
                            </a>

                            <a class="delete-competence" data-competence-id="{{ $q->id }}">
                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </b>
                            </a>
                        </div>
                    </td>
                    <form id="delete-competence-form-{{ $q->id }}"
                        action="{{ route('sigac.academic_coordination.competences.destroy', ['id' => $q->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
                @endforeach

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

