{{-- CRUD Parametro Variedad --}}
<div class="card">
    <div class="card-header">
        Variedad
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#"><i
            class='bx bx-plus icon'></i></button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($species as $a)
                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->lifecycle }}</td>
                        <td>
                            <a href="{{ route('agrocefa.species.edit', ['id' => $a->id]) }}"
                                class="btn btn-primary btn-sm"><i
                                class='bx bx-edit icon'></i></a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#eliminarAsistenciaModal"><i
                                class='bx bx-trash icon'></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>