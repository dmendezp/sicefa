{{-- CRUD parametro Cultivo --}}
<div class="card">
    <div class="card-header row"> <!-- Agrega la clase "row" para utilizar el sistema de grid -->
        <div class="col">{{ trans('agrocefa::cultivo.Crop') }}</div> <!-- Utiliza la clase "col" para ocupar todo el ancho -->
        @auth
            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                <div class="col-auto"> <!-- Utiliza la clase "col-auto" para que el botón no ocupe todo el espacio disponible -->
                    <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearcrop"><i class='bx bx-plus icon'></i>
                    </button>
                </div>
            @endif
        @endauth
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('agrocefa::cultivo.Name') }}</th>
                        <th>{{ trans('agrocefa::cultivo.Sown area') }}</th>
                        <th>{{ trans('agrocefa::cultivo.Seedtime') }}</th>
                        <th>{{ trans('agrocefa::cultivo.Plant Density') }}</th>
                        <th>{{ trans('agrocefa::movements.1T_Lot') }}</th>
                        <th>{{ trans('agrocefa::cultivo.Variety') }}</th>
                        <th>{{ trans('agrocefa::cultivo.End date') }}</th>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                <th>{{ trans('agrocefa::specie.Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($crops as $crop)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $crop->name }}</td>
                            <td>{{ $crop->sown_area }}</td>
                            <td>{{ $crop->seed_time }}</td>
                            <td>{{ $crop->density }}</td>
                            <td>
                                @if ($crop->environments->isNotEmpty())
                                    {{ $crop->environments->first()->name }}
                                @else
                                    Sin lote asociado
                                @endif
                            </td>
                            <td>{{ $crop->variety->name }}</td>
                            <td>{{ $crop->finish_date }}</td>
                            @auth
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit-crop"
                                            data-bs-target="#editCultivo_{{ $crop->id }}" data-bs-toggle="modal">
                                            <i class='bx bx-edit icon'></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-delete-crop" data-crop-id="{{ $crop->id }}">
                                            <i class='bx bx-trash icon'></i>
                                        </button>
                                    </td>

                                    {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.crop.destroy', 'id' => $crop->id], 'method' => 'POST', 'id' => 'delete-crop-form-' . $crop->id]) !!}
                                        @csrf
                                        @method('DELETE')
                                        <!-- Otros campos ocultos necesarios... -->
                                    {!! Form::close() !!}
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal Agregar Cultivo --}}
<div class="modal fade" id="crearcrop" tabindex="-1" aria-labelledby="crearcrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCropModalLabel">{{ trans('agrocefa::cultivo.Add Crop') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.crop.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="crop_name">{{ trans('agrocefa::cultivo.Crop Name') }}</label>
                        <input type="text" name="crop_name" id="crop_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sown_area">{{ trans('agrocefa::cultivo.Sown area') }}</label>
                        <input type="number" name="sown_area" id="sown_area" class="form-control"
                            placeholder="{{ trans('agrocefa::cultivo.Example: 5') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="seed_time">{{ trans('agrocefa::cultivo.Seedtime') }}</label>
                        <input type="date" name="seed_time" id="seed_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="density">{{ trans('agrocefa::cultivo.Plant Density') }}</label>
                        <input type="number" name="density" id="density" class="form-control"
                            placeholder="{{ trans('agrocefa::cultivo.Example: 5') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="environment_id">{{ trans('agrocefa::movements.1T_Lot') }}</label>
                        <select name="environment_id" id="environment_id" class="form-control">
                            <option value="">{{ trans('agrocefa::cultivo.Select Environment') }}</option>
                            @foreach ($environments as $environment)
                                <option value="{{ $environment->id }}">{{ $environment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="variety_id">{{ trans('agrocefa::cultivo.Variety') }}</label>
                        <select name="variety_id" id="varietyt_id" class="form-control">
                            <option value="">{{ trans('agrocefa::cultivo.Select Variety') }}</option>
                            @foreach ($varieties as $variety)
                                <option value="{{ $variety->id }}">{{ $variety->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="finish_date">{{ trans('agrocefa::cultivo.End date') }}</label>
                        <input type="date" name="finish_date" id="finish_date" class="form-control" >
                    </div>
                    <br>
                    <button type="submit"
                        class="btn standcolor">{{ trans('agrocefa::cultivo.Register Crop') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

{{-- Modal de Edición Cultivo --}}
@foreach ($crops as $crop)
    <div class="modal fade" id="editCultivo_{{ $crop->id }}" tabindex="-1" aria-labelledby="editCultivoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarCultivoModalLabel">{{ trans('agrocefa::cultivo.Edit Crop') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de edición con un ID único -->
                    {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.crop.update', $crop->id], 'method' => 'PUT', 'id' => 'edit-crop-form']) !!}
                    @csrf
                    <div class="form-group">
                        {!! Form::label('crop_name', trans('agrocefa::cultivo.Crop Name')) !!}
                        {!! Form::text('crop_name', $crop->name, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => trans('agrocefa::cultivo.Crop Name'),
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sown_area', trans('agrocefa::cultivo.Sown area')) !!}
                        <div class="input-group">
                            {!! Form::text('sown_area', $crop->sown_area, [
                                'class' => 'form-control',
                                'placeholder' => 'Ejemplo: 3,5 m²',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('seed_time', trans('agrocefa::cultivo.Seedtime')) !!}
                        {!! Form::text('seed_time', $crop->seed_time, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('density', trans('agrocefa::cultivo.Plant Density')) !!}
                        <div class="input-group">
                            {!! Form::text('density', $crop->density, [
                                'class' => 'form-control',
                                'placeholder' => 'Ejemplo: 5 plantas/m²',
                                'required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('environment_id', trans('agrocefa::movements.1T_Lot')) !!}
                        {!! Form::select('environment_id', $environments->pluck('name', 'id'), $crop->environment_id, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('variety_id', trans('agrocefa::cultivo.Variety')) !!}
                        {!! Form::select('variety_id', $varieties->pluck('name', 'id'), $crop->variety_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('finish_date', trans('agrocefa::cultivo.End date')) !!}
                        {!! Form::date('finish_date', $crop->finish_date, ['class' => 'form-control']) !!}
                    </div>
                    
                    <!-- Otros campos del formulario según tus necesidades -->
                    <br>
                    {!! Form::submit(trans('agrocefa::cultivo.Update Crop'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
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
                    <h5 class="modal-title" id="eliminarcultivoLabel">{{ trans('agrocefa::cultivo.Delete Crop') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ trans('agrocefa::cultivo.Are you sure you want to remove this Crop?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ trans('agrocefa::cultivo.Cancel') }}</button>
                    {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.crop.destroy', 'id' => $crop->id], 'method' => 'POST']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit(trans('agrocefa::cultivo.Delete'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- script de limpiar los campos cuando se va a agregar un nuevo cultivo --}}
<script>
    $(document).ready(function() {
        $('#crearcrop').on('show.bs.modal', function() {
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
    $('.btn-edit-crop').on('click', function(event) {
        var cropId = $(this).data('crop-id');

        // Obtener los datos del cultivo desde algún lugar (puede ser una API, base de datos, etc.)
        var cropData = cropsData.find(function(crop) {
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
        var formAction = '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.crop.update', ['id' => 'CROP_ID']) }}';
        formAction = formAction.replace('CROP_ID', cropId);

        // Actualizar la URL del formulario con el ID del cultivo
        $('#edit-crop-form').attr('action', formAction);
    });

    // Asegúrate de que los datos de los cultivos estén disponibles aquí
    var cropsData = [
        // ... Lista de objetos de cultivo con sus propiedades ...
    ];

    $('.btn-delete-crop').on('click', function(event) {
        var cropId = $(this).data('crop-id');

        // Mostrar SweetAlert para confirmar la eliminación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario de eliminación
                $('#delete-crop-form-' + cropId).submit();
            }
        });
    });

    $(document).ready(function() {
        $('#crearcrop').on('hidden.bs.modal', function() {
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