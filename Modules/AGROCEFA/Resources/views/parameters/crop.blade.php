{{-- CRUD parametro Cultivo --}}
<div class="card" style="width: 90%; margin-left: 40px">
    <div class="card-header">
        Cultivo
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearcrop"><i
            class='bx bx-plus icon'></i></button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-striped" style="width: 90%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Área Sembrada</th>
                    <th>Fecha de Siembra</th>
                    <th>Densidad</th>
                    <th>Ambiente</th>
                    <th>Variedad</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($crops as $a)
                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->sown_area }}</td>
                        <td>{{ $a->seed_time }}</td>
                        <td>{{ $a->density }}</td>
                        <td>{{ $a->environment_id }}</td>
                        <td>{{ $a->variety_id }}</td>
                        <td>{{ $a->finish_date }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-edit-crop"
                                data-bs-id="{{ $a->id }}"><i
                                class='bx bx-edit icon'></i></button>
                            <button class="btn btn-danger btn-sm btn-delete-crop" data-bs-toggle="modal"
                                data-bs-target="#eliminarCropModal{{ $a->id }}"><i
                                class='bx bx-trash icon'></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>