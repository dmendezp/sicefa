<div>
    <div class="table-responsive">
        <table id="external_activities" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#crearactividad">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($external_activities as $external_activity)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $external_activity->name }}</td>
                        <td class="text-center">{{ $external_activity->description }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('sigac::programming.parameters.external_activities.create')