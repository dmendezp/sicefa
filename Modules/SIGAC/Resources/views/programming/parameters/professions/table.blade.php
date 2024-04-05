<div>
    <div class="table-responsive">
        <table id="profession" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th>Nivel</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#addProfession">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professions as $p)      
                    <tr>
                        <td class="text-center">{{ $p->name }}</td>
                        <td class="text-center">{{ $p->level }}</td>
                        <td class="text-center">
                            <div class="opts">
                                <a  data-bs-toggle="modal" data-bs-target="#editProfession{{$p->id}}">
                                    <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Profesión">
                                        <i class="fas fa-edit"></i>
                                    </b>
                                </a>
                                @include('sigac::programming.parameters.professions.edit')

                                <a data-bs-toggle="modal" data-bs-target="#deleteProfession{{$p->id}}">
                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Profesión">
                                        <i class="fas fa-trash-alt"></i>
                                    </b>
                                </a>
                                @include('sigac::programming.parameters.professions.delete')
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('sigac::programming.parameters.professions.create')
