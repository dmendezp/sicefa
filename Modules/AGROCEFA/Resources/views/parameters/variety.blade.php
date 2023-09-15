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
                    <th>Especie</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($varieties as $variety) {{-- Cambia $varieties por $varieties --}}
                    <tr>
                        <td>{{ $variety->id }}</td>
                        <td>{{ $variety->name }}</td>
                        <td>{{ $variety->specie->name }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-edit-variety"
                                data-bs-target="#editarVariedadModal_{{ $variety->id }}"
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
@foreach ($species as $specie)
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
                        <label for="specie_id">Especie</label>
                        {!! Form::select('specie_id', $specie->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Registrar Variedad</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
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
               {{ trans('agrocefa::variety.edit variety')}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['agrocefa.varieties.delete', 'id' => $variety->id], 'method' => 'DELETE']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($varieties as $v)
<div class="modal fade" id="editarVariedadModal_{{ $v->id }}" tabindex="-1"
    aria-labelledby="editarVariedadModalLabel_{{ $v->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarVariedadModalLabel_{{ $v->id }}">Editar
                    Variedad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'route' => ['agrocefa.varieties.update', 'id' => $v->id],
                    'method' => 'POST',
                    'id' => "editVarietyForm_{$v->id}",
                ]) !!}
                @csrf
                @method('PUT')
                <div class="form-group">
                    {!! Form::label("name_{$v->id}", 'Nombre:') !!}
                    {!! Form::text('name', $v->name, ['id' => "name_{$v->id}", 'class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("specie_id", 'Especie:') !!}
                    {!! Form::select('specie_id', $specie->pluck('name', 'id'), null, ['class' => 'form-control']) !!}

                </div>
                <!-- Agrega más campos según tus necesidades -->
                <br>
                {!! Form::submit('Actualizar Variedad', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endforeach


<script>
    $('.btn-edit-variety').on('click', function(event) {
    var modalTarget = $(this).data('bs-target'); // Obtener el objetivo del modal desde el botón
    var varietyId = modalTarget.split('_')[1]; // Extraer el ID de la variedad del ID del modal

    // Imprime el ID en la consola para verificar
    console.log('Variedad ID:', varietyId);

    // Obtener los valores de los campos de edición
    var name = $('#name_' + varietyId).val();
    var lifecycle = $('#lifecycle_' + varietyId).val();

    // Llenar los campos del formulario con los datos de la variedad
    $('#editVarietyForm_' + varietyId + ' #name').val(name);
    $('#editVarietyForm_' + varietyId + ' #lifecycle').val(lifecycle);

    // Construir la URL del formulario con el ID de la variedad
    var formAction = '{{ route('agrocefa.varieties.update', ['id' => 'VARIETY_ID']) }}';
    formAction = formAction.replace('VARIETY_ID', varietyId);

    // Actualizar la URL del formulario con el ID de la variedad
    $('#editVarietyForm_' + varietyId).attr('action', formAction);
});

</script>


    



