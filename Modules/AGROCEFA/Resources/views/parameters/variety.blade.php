{{-- CRUD Parametro Variedad --}}
<div class="card" style="width: 90%; margin-left: 40px">
    <div class="card-header">
        variedad
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearvarieties"><i
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
                @foreach ($varieties as $variety) {{-- Cambia $varieties por $varieties --}}
                    <tr>
                        <td>{{ $variety->id }}</td>
                        <td>{{ $variety->name }}</td>
                        <td>{{ $variety->lifecycle }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-edit-varieties"
                               data-bs-target="#editvariedad_{{ $variety->id }}"
                               data-bs-toggle="modal">
                               <i class='bx bx-edit icon'></i>
                            </button>

                            <button class="btn btn-danger btn-sm btn-delete-variedad" data-bs-toggle="modal"
                                data-bs-target="#eliminarvariedad_{{ $variety->id }}"><i
                                class='bx bx-trash icon'></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal Crear variedad --}}
<div class="modal fade" id="crearvarieties" tabindex="-1" aria-labelledby="crearvarieties" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarVarietyModalLabel">Agregar Variedad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agrocefa.varieties.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre de la Variedad</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lifecycle">Ciclo de Vida</label>
                        <input type="text" name="lifecycle" id="lifecycle" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Registrar Variedad</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal de Eliminar variedad --}}
@foreach ($varieties as $variety)
    <div class="modal fade" id="eliminarvariedad_{{ $variety->id }}" tabindex="-1"
        aria-labelledby="eliminarvariedadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarvariedadLabel">Eliminar Variedad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta Variedad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['agrocefa.varieties.elim', 'id' => $variety->id], 'method' => 'DELETE']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

