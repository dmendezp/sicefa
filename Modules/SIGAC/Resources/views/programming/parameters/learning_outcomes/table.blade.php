<div>
    <div class="table-responsive">
        <table id="learning_customes" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">Competencia</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Horas</th>

                    <th class="text-center">
                        <a data-toggle="modal" data-target="#addLearning_outcome" onclick="">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($learning_outcomes as $l)
                <tr>
                    <td class="text-center">{{ $l->competencie->name }}</td>
                    <td class="text-center">{{ $l->name }}</td>
                    <td class="text-center">{{ $l->hour }}</td>
                
                    <td class="text-center">
                        <div class="opts">
                            <a  data-bs-toggle="modal" data-bs-target="#editResult{{$l->id}}">
                                <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Resultado">
                                    <i class="fas fa-edit"></i>
                                </b>
                            </a>

                            <a class="delete-learning" data-learning-id="{{ $l->id }}">
                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
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

            </tbody>
        </table>
    </div>
</div>

@include('sigac::programming.parameters.learning_outcomes.create')


<script>
    $(document).ready(function() {
            $('.delete-learning').on('click', function(event) {
            var learning_id = $(this).data('learning-id');
                console.log(learning_id); // Your value from
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
                    document.getElementById('delete-learning-form-' + learning_id).submit();
                }
            });
        });
    });
</script>