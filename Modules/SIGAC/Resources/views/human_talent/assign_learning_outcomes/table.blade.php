
<div class="table-responsive">
    <table id="assign_learning" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('sigac::learning_out_come.LearningOutComes')}}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Instructor')}}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Priority')}}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($learning_outcome_people))
            @foreach($learning_outcome_people as $learning_outcome_person)
                <tr>
                   
                    <td>{{ $learning_outcome_person->learning_outcome->name }}</td>
                    <td>
                        <ul>
                            <li>{{ $learning_outcome_person->person->fullname }}</li>
                        </ul>
                    </td>
                    <td class="text-center">{{ $learning_outcome_person->priority }}</td>
                    <td class="text-center">
                        <form id="delete-assignlearning-form-{{ $learning_outcome_person->id }}{{ $learning_outcome_person->person->id }}"
                            action="{{ route('sigac.academic_coordination.human_talent.assign_learning_outcomes.learning_out_people_destroy', ['learning_id' => $learning_outcome_person->id, 'person_id' => $learning_outcome_person->person->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <!-- Botón de eliminación con SweetAlert y atributo form -->
                            <a form="delete-assignlearning-form-{{ $learning_outcome_person->id }}{{ $learning_outcome_person->person->id }}"
                                onclick="confirmDelete(event);">
                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::profession.Eliminate')}}">
                                    <i class="fas fa-trash-alt"></i>
                                </b>
                            </a>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

