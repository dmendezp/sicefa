
<div>
    <div class="table-responsive">
        <table id="quarterlies" class="table">
            <thead>
                <tr>
                    <th class="text-center">Competencia</th>
                    <th class="text-center">Resultado de Aprendizaje</th>
                    <th class="text-center">Horas</th>
                    <th class="text-center">Instructor</th>
                    <th class="text-center">Agregar</th>
                </tr>
            </thead>
            <tbody>
                @for($trimestreNumber = 1; $trimestreNumber <= $courseNumber; $trimestreNumber++)
                    <tr>
                        <td colspan="4" class="text-center">Trimestre {{ $trimestreNumber }}</td>
                        <td colspan="1" class="text-center"><a href="{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.create', ['quarter_number' => $trimestreNumber , 'training_project_id' => $trainingProjectId]) }}">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a></td>
                    </tr>
                    @foreach($quarterlies as $competency => $trimestres)
                        @foreach($trimestres->where('quarter_number', $trimestreNumber) as $trimestre)
                            <tr>
                                @if($loop->first)
                                    <td rowspan="{{ count($trimestres) }}" class="text-center">{{ $competency }}</td>
                                @endif
                                <td class="">{{ $trimestre->learning_outcome->name }}</td>
                                <td class="">{{ $trimestre->learning_outcome->hour }}</td>
                                @if (count($trimestre->learning_outcome->people) > 0)
                                    @foreach($trimestre->learning_outcome->people as $person)
                                        <td class="">{{ $person->first_name }}</td>
                                    @endforeach
                                @else
                                    <td></td>
                                @endif
                                
                                <td class="text-center">
                                    <div class="opts">
                                        <a class="delete-quarterlie" data-quarterlie-id="{{ $trimestre->id }}">
                                            <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </b>
                                        </a>
                                    </div>
                                </td>
                                <form id="delete-quarterlie-form-{{ $trimestre->id }}"
                                      action="{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.destroy', ['id' => $trimestre->id]) }}"
                                      method="POST">
                                    @csrf
                                </form>
                            </tr>
                        @endforeach
                    @endforeach
                @endfor
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delete-quarterlie').on('click', function(event) {
            var competence_id = $(this).data('quarterlie-id');
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
                    document.getElementById('delete-quarterlie-form-' + competence_id).submit();
                }
            });
        });
    });
</script>
