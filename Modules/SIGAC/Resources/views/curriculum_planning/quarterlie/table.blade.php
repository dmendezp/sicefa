
<div>
    <div class="table-responsive">
        <table id="" class="table">
            <thead>
                <tr>
                    <th class="text-center">Competencia</th>
                    <th class="text-center">Resultado de Aprendizaje</th>
                    <th class="text-center">Horas</th>
                    <th class="text-center">Perfil</th>
                    <th class="text-center">Agregar</th>
                </tr>
            </thead>
            <tbody>
                @for($trimestreNumber = 1; $trimestreNumber <= $courseNumber; $trimestreNumber++)
                    <tr class="quarter">
                        <td colspan="4" class="text-center"><b>Trimestre {{ $trimestreNumber }}</b></td>
                        <td colspan="1" class="text-center">
                            <a data-toggle="modal" data-target="#addTrimestralizacion" data-trimestre="{{ $trimestreNumber }}" onclick="">
                                <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                    <i class="fas fa-plus-circle"></i>
                                </b>
                            </a>
                        </td>
                    </tr>
                    @foreach($quarterlies as $competency => $trimestres)
                        @foreach($trimestres->where('quarter_number', $trimestreNumber) as $trimestre)
                            <tr>
                                <td class="text-center">{{ $competency }}</td>
                                <td class="">{{ $trimestre->learning_outcome->name }}</td>
                                <td class="text-center">{{ $trimestre->hour }}</td>
                                @if (count($trimestre->learning_outcome->people) > 0)
                                <td class="text-center">
                                    @foreach($trimestre->learning_outcome->competencie->professions as $profession)
                                        {{ $profession->name }} <br>
                                        <br>
                                    @endforeach
                                </td>
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
@include('sigac::curriculum_planning.quarterlie.create')

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

         // Capturar el número de trimestre cuando se haga clic en el botón de agregar
        $('[data-toggle="modal"]').on('click', function() {
            var trimestreNumber = $(this).data('trimestre');
            $('#trimestre_number_input').val(trimestreNumber); // Asignar el número de trimestre al campo oculto
        });
    });
</script>
