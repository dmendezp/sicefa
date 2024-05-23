{{-- CRUD Parametro Recurso --}}
<div class="card">
    <div class="card-header">
        {{ trans('hdc::parameters.environment_aspects') }}
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearaspecto"><i class="fas fa-add"></i>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-2">{{ trans('hdc::parameters.1T_Name') }}</th>
                        <th class="col-2">{{ trans('hdc::parameters.resource') }}</th>
                        <th class="col-2">{{ trans('hdc::parameters.measurement_unit') }}</th>
                        <th class="col-2">{{ trans('hdc::parameters.aspect_type') }}</th>
                        <th class="col-2">{{ trans('hdc::parameters.Conversion_factor') }}</th>
                        <th>{{ trans('hdc::parameters.Consumption_type')}}</th>
                        <th>{{ trans('hdc::parameters.Status')}}</th>
                        @auth
                            @if (Auth::user()->havePermission('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter'))
                                <th class="col-2">{{ trans('hdc::parameters.1T_Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach($envs as $e)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->name }}</td>
                            <td>{{ $e->resource->name }}</td>
                            <td>{{ $e->measurement_unit->name }}</td>
                            <td>{{ $e->aspect_type }}</td>
                            <td>{{ $e->conversion_factor }}</td>
                            <td>@if ($e->personal == 1)
                                Actividad general
                            @else
                                Personal
                            @endif</td>
                            <td>{{ $e->state }}</td>
                            @auth
                                @if (Auth::user()->havePermission('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter'))
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit-aspect" data-bs-toggle="modal"
                                            data-bs-target="#editaraspecto_{{ $e->id }}"
                                            data-aspecto-name="{{ $e->name }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger btn-sm btn-delete-aspect" data-externalactivity-id="{{ $e->id }}"><i class="fas fa-trash-alt"></i></button>

                                        <form id="delete-externalactivity-form-{{ $e->id }}"
                                            action="{{ route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.environment_aspects.destroy', ['id' => $e->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>

{{-- Modal Aspecto Ambiental --}}
<div class="modal fade" id="crearaspecto" tabindex="-1" aria-labelledby="crearaspecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsisteciaModalLabel">{{ trans('hdc::parameters.Add_Enviromental_aspect') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.environment_aspects.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', trans('hdc::parameters.Modal_Name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Aspecto Ambiental']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('resource', trans('hdc::parameters.Modal_resource')) !!}
                    {!! Form::select('resource_id', $resources, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('measurement_unit', trans('hdc::parameters.Modal_Measurement_unit')) !!}
                    {!! Form::select('measurement_unit_id', $measurement_unit, ['class' => 'form-control']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('aspect_type', trans('hdc::parameters.Modal_aspect_type')) !!}
                    {!! Form::select('aspect_type', ['' => 'Seleccione un tipo de aspecto', 'consumo' => 'Consumo', 'residuo' => 'Residuo'], ['class' => 'form-control']) !!}
                </div> 
                <div class="form-group">
                    {!! Form::label('conversion_factor', trans('hdc::parameters.Modal_conversion_factor')) !!}
                    {!! Form::text('conversion_factor', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el factor de conversión']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('personal', trans('hdc::parameters.Modal_consumption_type')) !!}
                    {!! Form::select('personal', ['' => 'Seleccione el tipo de consumo', '1' => 'Actividad general', '0' => 'Personal'], ['class' => 'form-control']) !!}
                </div>
                <br>
                {!! Form::submit(trans('hdc::parameters.Btn_add_enviromental_aspect'), ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@foreach($envs as $e)
    {{-- Modal editar Aspecto Ambiental --}}
    <div class="modal fade" id="editaraspecto_{{$e->id}}" tabindex="-1" aria-labelledby="editaraspecto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsisteciaModalLabel">{{ trans('hdc::parameters.Edit_Environmental_Aspect')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.environment_aspects.update', 'method' => 'POST']) !!}
                    @csrf
                    <div class="form-group">
                        {!! Form::hidden('id', $e->id) !!}
                        {!! Form::label('name', trans('hdc::parameters.Modal_Name')) !!}
                        {!! Form::text('name', $e->name, ['class' => 'form-control', 'placeholder' => 'Nombre del aspecto ambiental']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('resource', trans('hdc::parameters.Modal_resource')) !!}
                        {!! Form::select('resource_id', $resources, $e->resource_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('measurement_unit', trans('hdc::parameters.Modal_resource')) !!}
                        {!! Form::select('measurement_unit_id', $measurement_unit, $e->measurement_unit_id, ['class' => 'form-control']) !!}
                    </div> 
                    <div class="form-group">
                        {!! Form::label('aspect_type', trans('hdc::parameters.Modal_aspect_type')) !!}
                        {!! Form::select('aspect_type', ['' => 'Seleccione un tipo de aspecto', 'Consumo' => 'Consumo', 'Residuo' => 'Residuo'], $e->aspect_type,['class' => 'form-control']) !!}
                    </div> 
                    <div class="form-group">
                        {!! Form::label('conversion_factor', trans('hdc::parameters.Modal_conversion_factor')) !!}
                        {!! Form::text('conversion_factor', $e->conversion_factor, ['class' => 'form-control', 'placeholder' => 'Ingrese el factor de conversión']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('personal', trans('hdc::parameters.Modal_consumption_type')) !!}
                        {!! Form::select('personal', ['' => 'Seleccione el tipo de consumo', '1' => 'Actividad general', '0' => 'Personal'], $e->personal, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('state', trans('hdc::parameters.Status')) !!}
                        {!! Form::select('state', ['' => 'Seleccione un estado', 'Activo' => 'Activo', 'Inactivo' => 'Inactivo'], $e->state, ['class' => 'form-control']) !!}
                    </div>
                    <br>
                    {!! Form::submit(trans('hdc::parameters.Btn_save_enviromental_aspect'), ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

 
@endforeach

<script>
    $(document).ready(function() {
            $('.btn-delete-aspect').on('click', function(event) {
            var external_activity_id = $(this).data('externalactivity-id');

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
                    document.getElementById('delete-externalactivity-form-' + external_activity_id).submit();
                }
            });
        });
    });
</script>