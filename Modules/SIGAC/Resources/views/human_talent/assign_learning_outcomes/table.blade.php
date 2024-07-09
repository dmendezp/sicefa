<div class="table-responsive">
    <table id="assign_learning" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('sigac::learning_out_come.LearningOutComes') }}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Instructor') }}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Priority') }}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($learning_outcome_people))
                @php
                    $groupedLearningOutcomes = $learning_outcome_people->groupBy('learning_outcome.name');
                @endphp
                @foreach($groupedLearningOutcomes as $learning_outcome_name => $people)
                    <tr>
                        <td>{{ $learning_outcome_name }}</td>
                        <td>
                            <ul>
                                @foreach($people as $learning_outcome_person)
                                    <li>{{ $learning_outcome_person->person->fullname }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            <!-- Mostrar prioridad si es necesario. De lo contrario, eliminar esta columna si no se necesita -->
                            @foreach($people as $learning_outcome_person)
                                {{ $learning_outcome_person->priority }}
                                <br>
                                <br>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach($people as $learning_outcome_person)
                                <form id="delete-assignlearning-form-{{ $learning_outcome_person->id }}{{ $learning_outcome_person->person->id }}"
                                    action="{{ route('sigac.academic_coordination.human_talent.assign_learning_outcomes.destroy', ['learning_id' => $learning_outcome_person->id, 'person_id' => $learning_outcome_person->person->id]) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a form="delete-assignlearning-form-{{ $learning_outcome_person->id }}{{ $learning_outcome_person->person->id }}"
                                       onclick="confirmDelete(event);" style="margin-right: 10px;">
                                        <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::profession.Eliminate') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </b>
                                    </a>
                                </form>
                                <br>
                                <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('.delete-person_profession').on('click', function(event) {
            var profession_program_id = $(this).data('person_profession-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '{{trans('sigac::profession.You_Sure')}}',
                text: '{{trans('sigac::profession.This_Action_Can_Undone')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{trans('sigac::profession.Yes_Delete')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-person_profession-form-' + profession_program_id).submit();
                }
            });
        });
    });
</script>
