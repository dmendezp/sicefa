
<div class="table-responsive">
    <table id="class_environment" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('Competencia') }}</th>
                <th class="text-center">{{ trans('Clase de Ambiente') }}</th>
                <th class="text-center">{{ trans('sigac::learning_out_come.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($competencies as $competencie)
                <tr>
                    <td>{{ $competencie->name }}</td>
                    <td>
                        <ul>
                            @foreach($competencie->class_environments as $class_environment)
                                <li>{{ $class_environment->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        @foreach($competencie->class_environments as $class_environment)
                        <form id="delete-training_project-form-{{ $class_environment->id }}{{ $competencie->id }}"
                            action="{{ route('sigac.academic_coordination.curriculum_planning.competencie_class.destroy', ['class_environment_id' => $class_environment->id, 'competencie_id' => $competencie->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <!-- Botón de eliminación con SweetAlert y atributo form -->
                            <a form="delete-training_project-form-{{ $class_environment->id }}{{ $competencie->id }}"
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
        
        </tbody>
    </table>
</div>

