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
                @foreach ($crops as $crop)
                    <tr>
                        <td>{{ $crop->id }}</td>
                        <td>{{ $crop->name }}</td>
                        <td>{{ $crop->sown_area }}</td>
                        <td>{{ $crop->seed_time }}</td>
                        <td>{{ $crop->density }}</td>
                        <td>
                            @if ($crop->environments->isNotEmpty())
                                {{ $crop->environments->first()->name }}
                            @else
                                Sin ambiente asociado
                            @endif
                        </td>
                        <td>{{ $crop->variety->name }}</td>
                        <td>{{ $crop->finish_date }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-edit-crop"
                                data-bs-target="#editCultivo_{{ $crop->id }}"
                                data-bs-toggle="modal">
                                <i class='bx bx-edit icon'></i>
                            </button>


                            <button class="btn btn-danger btn-sm btn-delete-crop" data-bs-toggle="modal"
                                data-bs-target="#eliminarcultivo_{{ $crop->id }}"><i
                                    class='bx bx-trash icon'></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Modal Agregar Cultivo --}}
<div class="modal fade" id="crearcrop" tabindex="-1" aria-labelledby="crearcrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCropModalLabel">Agregar Cultivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agrocefa.crop.create')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="crop_name">Nombre del Cultivo</label>
                        <input type="text" name="crop_name" id="crop_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sown_area">Área Sembrada</label>
                        <input type="text" name="sown_area" id="sown_area" class="form-control" placeholder="Ejemplo: 3,5 m²" required>
                    </div> 
                    <div class="form-group">
                        <label for="seed_time">Fecha de Siembra</label>
                        <input type="date" name="seed_time" id="seed_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="density">Densidad de Plantas</label>
                        <input type="text" name="density" id="density" class="form-control" placeholder="Ejemplo: 5 plantas/m²" required>
                    </div>
                    <div class="form-group">
                        <label for="environment_id">Ambiente</label>
                        <select name="environment_id" id="environment_id" class="form-control">
                            <option value="">Seleccionar Ambiente</option>
                            @foreach ($environments as $environment)
                                <option value="{{ $environment->id }}">{{ $environment->name }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="variety_id">Variedad</label>
                        <select name="variety_id" id="varietyt_id" class="form-control">
                            <option value="">Seleccionar Variedad</option>
                            @foreach ($varieties as $variety)
                                <option value="{{ $variety->id }}">{{ $variety->name }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="finish_date">Fecha Fin</label>
                        <input type="date" name="finish_date" id="finish_date" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Registrar Cultivo</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

{{-- Modal de Edición Cultivo --}}
@foreach ($crops as $crop)
<div class="modal fade" id="editCultivo_{{ $crop->id }}" tabindex="-1"
    aria-labelledby="editCultivoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCultivoModalLabel">Editar Cultivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición con un ID único -->
                {!! Form::open(['route' => ['agrocefa.crop.edit', $crop->id], 'method' => 'PUT', 'id' => 'edit-crop-form']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('crop_name', 'Nombre del Cultivo') !!}
                    {!! Form::text('crop_name', $crop->name, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sown_area', 'Área Sembrada') !!}
                    <div class="input-group">
                        {!! Form::text('sown_area', $crop->sown_area, ['class' => 'form-control', 'placeholder' => 'Ejemplo: 3,5 m²', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('seed_time', 'Fecha de Siembra') !!}
                    {!! Form::text('seed_time', $crop->seed_time, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('density', 'Densidad de Plantas') !!}
                    <div class="input-group">
                        {!! Form::text('density', $crop->density, ['class' => 'form-control', 'placeholder' => 'Ejemplo: 5 plantas/m²', 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('environment_id', 'Ambiente') !!}
                    {!! Form::select('environment_id', $environments->pluck('name', 'id'), $crop->environment_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('variety_id', 'Variedad') !!}
                    {!! Form::select('variety_id', $varieties->pluck('name', 'id'), $crop->variety_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('finish_date', 'Fecha Fin') !!}
                    {!! Form::text('finish_date', $crop->finish_date, ['class' => 'form-control', 'required']) !!}
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit('Actualizar Cultivo', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endforeach


{{-- Modal de Eliminar cultivo --}}
@foreach ($crops as $crop)
    <div class="modal fade" id="eliminarcultivo_{{ $crop->id }}" tabindex="-1"
        aria-labelledby="eliminarcultivoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarcultivoLabel">Eliminar Cultivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este Cultivo?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['agrocefa.crop.delete', 'id' => $crop->id], 'method' => 'POST']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- script de limpiar los campos cuando se va a agregar un nuevo cultivo --}}
<script>
    $(document).ready(function() {
        $('#crearcrop').on('show.bs.modal', function () {
            // Limpiar los campos del formulario
            $('#crop_name').val('');
            $('#seed_time').val('');
            $('#density').val('');
            $('#environment_id').val('');
            $('#varietyt_id').val('');
            $('#finish_date').val('');
        });
    });
</script>



<script>
$('.btn-edit-crop').on('click', function (event) {
    var cropId = $(this).data('crop-id');

    // Obtener los datos del cultivo desde algún lugar (puede ser una API, base de datos, etc.)
    var cropData = cropsData.find(function (crop) {
        return crop.id === cropId;
    });

    // Llenar los campos del formulario con los datos del cultivo
    $('#edit-crop-form').find('#name').val(cropData.name);
    $('#edit-crop-form').find('#sown_area').val(cropData.sown_area);
    $('#edit-crop-form').find('#seed_time').val(cropData.seed_time);
    $('#edit-crop-form').find('#density').val(cropData.density);
    $('#edit-crop-form').find('#variety_id').val(cropData.variety_id);
    $('#edit-crop-form').find('#finish_date').val(cropData.finish_date);

    // Construir la URL del formulario con el ID del cultivo
    var formAction = '{{ route('agrocefa.crop.edit', ['id' => 'CROP_ID']) }}';
    formAction = formAction.replace('CROP_ID', cropId);

    // Actualizar la URL del formulario con el ID del cultivo
    $('#edit-crop-form').attr('action', formAction);
});

// Asegúrate de que los datos de los cultivos estén disponibles aquí
var cropsData = [
    // ... Lista de objetos de cultivo con sus propiedades ...
];
</script>


