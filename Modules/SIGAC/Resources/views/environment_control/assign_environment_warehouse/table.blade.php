
<div class="table-responsive">
    <table id="professionxprogram" class="display table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">{{ trans('Ambiente')}}</th>
                <th class="text-center">{{ trans('Bodega')}}</th>
                <th class="text-center">{{ trans('Responsable')}}</th>
                <th class="text-center">{{ trans('sigac::profession.Actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($assigns))
            @foreach($assigns as $assign)
                <tr>
                    <td class="text-center">{{ $assign->environment->name }}</td>
                    <td class="text-center">{{ $assign->warehouse->name }}</td>
                    <td class="text-center">{{ $assign->person->fullname }}</td>
                    <td class="text-center">
                        <form id="delete-professionprogram-form-{{ $assign->environment_id }}{{ $assign->warehouse_id }}"
                            action="{{ route('sigac.instructor.environmentcontrol.assign_environment_warehouse.destroy', ['environment_id' => $assign->environment_id, 'warehouse_id' => $assign->warehouse_id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                    
                            <!-- Botón de eliminación con SweetAlert y atributo form -->
                            <a form="delete-professionprogram-form-{{ $assign->environment_id }}{{ $assign->warehouse_id }}"
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

