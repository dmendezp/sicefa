
<div class="table-responsive">
    <table id="training_projecttable" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('sigac::learning_out_come.TrainingProject') }}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Courses') }}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($training_projects))
            @foreach($training_projects as $training_project)
                <tr>
                    <td>{{ $training_project->name }}</td>
                    <td>
                        <ul>
                            @foreach($training_project->courses as $course)
                                <li>{{ $course->program->name }} - {{ $course->code }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        @foreach($training_project->courses as $course)
                        <form id="delete-training_project-form-{{ $training_project->id }}{{ $course->id }}"
                            action="{{ route('sigac.academic_coordination.curriculum_planning.course_trainig_project.destroy', ['training_project_id' => $training_project->id, 'course_id' => $course->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <!-- Botón de eliminación con SweetAlert y atributo form -->
                            <a form="delete-training_project-form-{{ $training_project->id }}{{ $course->id }}"
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

