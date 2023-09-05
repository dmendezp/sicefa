{{-- CRUD Parametro Metodo de Aplicacion --}}
<div class="card">
    <div class="card-header">
        Metodo de Aplicacion
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearaplicacion"><i
                class='bx bx-plus icon'></i></button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="col-3">Descripción Labor</th>
                    <th class="col-1">Método de Aplicación</th>
                    <th>Objetivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laborsData as $data)
                    @foreach ($data['labors'] as $labor)
                        @foreach ($labor['agriculturals'] as $agricultural)
                            <tr>
                                <td>{{ $agricultural['agricultural_id'] }}</td>
                                <td>{{ $labor['description'] }}</td>
                                <td>{{ $agricultural['agricultural_method'] }}</td>
                                <td>{{ $agricultural['objective'] }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-edit-aplication"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editarMetodoAplicacion_{{ $agricultural['agricultural_id'] }}"
                                        data-aplication-id="{{ $agricultural['agricultural_id'] }}">
                                        <i class="bx bx-edit icon"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-delete-aplication" data-bs-toggle="modal"
                                        data-bs-target="#eliminaraplicacion_{{ $agricultural['agricultural_id'] }}">
                                        <i class="bx bx-trash icon"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal Metodo de Aplicacion --}}
@foreach ($laborsData as $data)
    @foreach ($data['labors'] as $labor)
<div class="modal fade" id="crearaplicacion" tabindex="-1" aria-labelledby="crearaplicacion"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregaraplicaiconModalLabel">Agregar Metodo de Aplicacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'agrocefa.aplication.create', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('labor_id', 'Labor') !!}
                    {!! Form::select('labor_id', [$labor['labor_id'] => $labor['description']], null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('application_method', 'Nombre del Metodo de Aplicacion') !!}
                    {!! Form::text('application_method', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('objective', 'Objetivo') !!}
                    {!! Form::text('objective', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <br>
                {!! Form::submit('Registrar Metodo de Aplicacion', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach
{{-- Modal de Edición Metodo de Aplicación --}}
@foreach ($laborsData as $data)
@foreach ($data['labors'] as $labor)
    @foreach ($labor['agriculturals'] as $agricultural)
        <div class="modal fade"
            id="editarMetodoAplicacion_{{ $agricultural['agricultural_id'] }}" tabindex="-1"
            aria-labelledby="editarMetodoAplicacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarMetodoAplicacionLabel">Editar Método de Aplicación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('agrocefa.aplication.edit', ['id' => $agricultural['agricultural_id']]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="labor_id">Labor</label>
                                <select name="labor_id" id="labor_id" class="form-control">
                                    <option value="{{ $labor['labor_id'] }}">{{ $labor['description'] }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="application_method">Nombre del Método de Aplicación</label>
                                <input type="text" name="application_method" id="application_method"
                                    class="form-control" value="{{ $agricultural['agricultural_method'] }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="objective">Objetivo</label>
                                <input type="text" name="objective" id="objective" class="form-control"
                                    value="{{ $agricultural['objective'] }}" required>
                            </div>
                            <!-- Otros campos del formulario según tus necesidades -->
                            <br>
                            <button type="submit" class="btn btn-primary">Actualizar Método de Aplicación</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
@endforeach
{{-- Modal de Eliminar Metodo de Aplicaicon --}}
@foreach ($laborsData as $data)
@foreach ($data['labors'] as $labor)
    @foreach ($labor['agriculturals'] as $agricultural)
        <!-- Modal de Eliminación -->
        <div class="modal fade" id="eliminaraplicacion_{{ $agricultural['agricultural_id'] }}" tabindex="-1"
            aria-labelledby="eliminaraplicacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminaraplicacionLabel">Eliminar Método de Aplicación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este Método de Aplicación?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        {!! Form::open(['route' => ['agrocefa.aplication.delete', 'id' => $agricultural['agricultural_id']], 'method' => 'DELETE']) !!}
                        @csrf
                        @method('DELETE')
                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
@endforeach

<script>
    $('.btn-edit-aplication').on('click', function(event) {
        // Obtener el ID del Método de Aplicación desde el botón que se hizo clic
        var aplicationId = $(this).data('aplication-id');

        // Llenar los campos del formulario de edición con los datos del Método de Aplicación
        $('#labor_id').val('{{ $labor['labor_id'] }}');
        $('#application_method').val('{{ $agricultural['agricultural_method'] }}');
        $('#objective').val('{{ $agricultural['objective'] }}');
        // Agrega más campos según sea necesario

        // Actualizar la URL del formulario de edición con el ID del Método de Aplicación
        var formAction = '{{ route('agrocefa.aplication.edit', ['id' => 'APLICATION_ID']) }}';
        formAction = formAction.replace('APLICATION_ID', aplicationId);

        // Actualizar el atributo action del formulario con la nueva URL
        $('#editarMetodoAplicacionLabel form').attr('action', formAction);
    });

</script>