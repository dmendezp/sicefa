
<div class="table-responsive">
    <table id="assign_learning" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('sigac::learning_out_come.LearningOutComes')}}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Instructor')}}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($learning_outcomes))
            @foreach($learning_outcomes as $learning_outcome)
                <tr>
                    <td>{{ $learning_outcome->name }}</td>
                    <td>
                        <ul>
                            @foreach($learning_outcome->people as $instructor)
                                <li>{{ $instructor->fullname }}</li>
                            @endforeach
                        </ul>
                    </td>
                    
                    <td class="text-center">
                        @foreach($learning_outcome->people as $instructor)
                        <form id="delete-assignlearning-form-{{ $learning_outcome->id }}{{ $instructor->id }}"
                            action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.learning_out_people_destroy', ['learning_id' => $learning_outcome->id, 'person_id' => $instructor->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <!-- Botón de eliminación con SweetAlert y atributo form -->
                            <a form="delete-assignlearning-form-{{ $learning_outcome->id }}{{ $instructor->id }}"
                                onclick="confirmDelete(event);">
                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="{{ trans('sigac::profession.Eliminate')}}">
                                    <i class="fas fa-trash-alt"></i>
                                </b>
                            </a>
                        </form>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

