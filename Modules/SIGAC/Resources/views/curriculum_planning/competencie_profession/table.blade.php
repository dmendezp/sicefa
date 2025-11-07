
<div class="table-responsive">
    <table id="professionxprogram" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('sigac::profession.Competencies')}}</th>
                <th class="text-center">{{ trans('sigac::profession.Profession')}}</th>
                <th class="text-center">{{ trans('sigac::profession.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($competencies))
            @foreach($competencies as $competency)
                <tr>
                    <td>{{ $competency->name }}</td>
                    <td>
                        <ul>
                            @foreach($competency->professions as $profession)
                                <li>{{ $profession->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    
                    <td class="text-center">
                        @foreach($competency->professions as $profession)
                        <form id="delete-professionprogram-form-{{ $competency->id }}{{ $profession->id }}"
                            action="{{ route('sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_destroy', ['competencie_id' => $competency->id, 'profession_id' => $profession->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <!-- Botón de eliminación con SweetAlert y atributo form -->
                            <a form="delete-professionprogram-form-{{ $competency->id }}{{ $profession->id }}"
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

