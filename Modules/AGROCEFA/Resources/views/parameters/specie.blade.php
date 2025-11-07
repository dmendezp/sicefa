{{-- CRUD Parametro Especie --}}
<div class="card">
    <div class="card-header">
        {{ trans('agrocefa::specie.Species') }}
        @auth
            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearspecie"><i
                        class='bx bx-plus icon'></i>
                </button>
            @endif
        @endauth
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('agrocefa::specie.Name') }}</th>
                        <th>{{ trans('agrocefa::specie.lifecycle') }}</th>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                <th>{{ trans('agrocefa::specie.Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($species as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->lifecycle }}</td>
                            @auth
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                    <td>
                                        <div class="button-group">
                                            <button class="btn btn-primary btn-sm btn-edit-specie" data-bs-toggle="modal"
                                                data-bs-target="#editarEspecieModal_{{ $a->id }}"
                                                data-specie-id="{{ $a->id }}"><i class='bx bx-edit icon'></i>
                                            </button>
                                            
                                            <button class="btn btn-danger btn-sm btn-delete-specie" data-specie-id="{{ $a->id }}">
                                                <i class='bx bx-trash icon'></i>
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                        {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.specie.destroy', 'id' => $a->id], 'method' => 'DELETE', 'id' => 'delete-specie-form-' . $a->id]) !!}
                        @csrf
                        @method('DELETE')
                        {!! Form::close() !!}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal agregar Especie --}}
<div class="modal fade" id="crearspecie" tabindex="-1" aria-labelledby="crearspecie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">{{ trans('agrocefa::specie.AddSpecie') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.specie.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', trans('agrocefa::specie.Name') . ':') !!}
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lifecycle', trans('agrocefa::specie.lifecycle') . ':') !!}
                    {!! Form::select('lifecycle', ['Transitorio' => 'Transitorio', 'Permanente' => 'Permanente'], null, [
                        'id' => 'lifecycle',
                        'class' => 'form-control',
                        'required',
                    ]) !!}
                </div>
                <!-- Agrega más campos según tus necesidades -->
                <br>
                {!! Form::submit(trans('agrocefa::specie.Register'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

{{-- Modal editar especie --}}
@foreach ($species as $a)
    <div class="modal fade" id="editarEspecieModal_{{ $a->id }}" tabindex="-1"
        aria-labelledby="editarEspecieModalLabel_{{ $a->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarEspecieModalLabel_{{ $a->id }}">
                        {{ trans('agrocefa::specie.UpdateSpecie') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open([
                        'route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.specie.update', 'id' => $a->id],
                        'method' => 'POST',
                        'id' => "editSpeciesForm_{$a->id}",
                    ]) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        {!! Form::label("name_{$a->id}", trans('agrocefa::specie.Name') . ':') !!}
                        {!! Form::text('name', $a->name, ['id' => "name_{$a->id}", 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("lifecycle_{$a->id}", trans('agrocefa::specie.lifecycle') . ':') !!}
                        {!! Form::select('lifecycle', ['Transitorio' => 'Transitorio', 'Permanente' => 'Permanente'], $a->lifecycle, [
                            'id' => "lifecycle_{$a->id}",
                            'class' => 'form-control',
                            'required',
                        ]) !!}
                    </div>
                    <!-- Agrega más campos según tus necesidades -->
                    <br>
                    {!! Form::submit(trans('agrocefa::specie.UpdateSpecie'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Modal de Eliminar Actividad --}}
@foreach ($species as $a)
    <div class="modal fade" id="eliminarspecie_{{ $a->id }}" tabindex="-1"
        aria-labelledby="eliminaractividadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminaractividadLabel">{{ trans('agrocefa::specie.DeleteSpecie') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ trans('agrocefa::specie.MessageDelete') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ trans('agrocefa::specie.Cancel') }}</button>
                    {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.specie.destroy', 'id' => $a->id], 'method' => 'POST']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit(trans('agrocefa::specie.Delete'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    $('.btn-edit-specie').on('click', function(event) {
        var specieId = $(this).data('specie-id'); // Obtener el ID de la especie desde el botón

        // Imprime el ID en la consola para verificar
        console.log('Especie ID:', specieId);

        // Obtener los valores de los campos de edición
        var name = $('#name_' + specieId).val();
        var lifecycle = $('#lifecycle_' + specieId).val();

        // Llenar los campos del formulario con los datos de la especie
        $('#editSpeciesForm_' + specieId + ' #name').val(name);
        $('#editSpeciesForm_' + specieId + ' #lifecycle').val(lifecycle);

        // Construir la URL del formulario con el ID de la especie
        var formAction = '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.specie.update', ['id' => 'SPECIE_ID']) }}';
        formAction = formAction.replace('SPECIE_ID', specieId);

        // Actualizar la URL del formulario con el ID de la especie
        $('#editSpeciesForm_' + specieId).attr('action', formAction);
    });

    $('.btn-delete-specie').on('click', function(event) {
        var specieId = $(this).data('specie-id');

        // Mostrar SweetAlert para confirmar la eliminación
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario de eliminación
                $('#delete-specie-form-' + specieId).submit();
            }
        });
    });
</script>
