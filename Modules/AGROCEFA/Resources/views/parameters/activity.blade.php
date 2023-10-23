{{-- CRUD Parametro Actividad --}}
<div class="card">
    <div class="card-header">
        {{ trans('agrocefa::parameters.Activity') }}
        @auth
            @if (Auth::user()->havePermission('agrocefa.admin.parameters.manage'))
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearactividad"><i
                        class='bx bx-plus icon'></i>
                </button>
            @endif
        @endauth
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-1">{{ trans('agrocefa::parameters.1T_Name') }}</th>
                    <th class="col-1">{{ trans('agrocefa::parameters.1T_Type') }}</th>
                    <th class="col-2">{{ trans('agrocefa::parameters.1T_Description') }}</th>
                    <th class="col-1">{{ trans('agrocefa::parameters.1T_Period') }}</th>
                    @auth
                        @if (Auth::user()->havePermission('agrocefa.admin.parameters.manage'))
                            <th class="col-3">{{ trans('agrocefa::parameters.1T_Actions') }}</th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->activity_type->name }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->period }}</td>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.admin.parameters.manage'))
                                <td>
                                    <button class="btn btn-primary btn-sm btn-edit-activity" data-bs-toggle="modal"
                                        data-bs-target="#editaractividad_{{ $activity->id }}"
                                        data-activity-id="{{ $activity->id }}"><i class='bx bx-edit icon'></i></button>
                                    <button class="btn btn-danger btn-sm btn-delete-activity" data-bs-toggle="modal"
                                        data-bs-target="#eliminaractividad_{{ $activity->id }}"><i
                                            class='bx bx-trash icon'></i></button>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
{{-- Modal Actividad --}}
<div class="modal fade" id="crearactividad" tabindex="-1" aria-labelledby="crearactividad" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'agrocefa.activity.create', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('activity_type_id', trans('agrocefa::parameters.Modal_Type_Activity')) !!}
                    {!! Form::select('activity_type_id', $activityTypes->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name', trans('agrocefa::parameters.Modal_Name_Activity')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', trans('agrocefa::parameters.Modal_Description')) !!}
                    {!! Form::text('description', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('period', trans('agrocefa::parameters.Modal_Period')) !!}
                    {!! Form::select(
                        'period',
                        ['Diario' => 'Diario', 'Quincenal' => 'Quincenal', 'Mensual' => 'Mensual', 'Anual' => 'Anual'],
                        null,
                        ['class' => 'form-control'],
                    ) !!}
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit(trans('agrocefa::parameters.Btn_Register_Activity'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

{{-- Modal de Edición Actividad --}}
@foreach ($activities as $activity)
    <div class="modal fade" id="editaractividad_{{ $activity->id }}" tabindex="-1"
        aria-labelledby="editaractividadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['agrocefa.activity.edit', 'id' => $activity->id], 'method' => 'POST']) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        {!! Form::label('activity_type_id', 'Tipo de Actividad') !!}
                        {!! Form::select('activity_type_id', $activityTypes->pluck('name', 'id'), $activity->activity_type_id, [
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Nombre de la Actividad') !!}
                        {!! Form::text('name', $activity->name, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descripción') !!}
                        {!! Form::text('description', $activity->description, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('period', 'Periodo') !!}
                        {!! Form::text('period', $activity->period, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <!-- Otros campos del formulario según tus necesidades -->
                    <br>
                    {!! Form::submit('Actualizar Actividad', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- Modal de Eliminar Actividad --}}
@foreach ($activities as $activity)
    <div class="modal fade" id="eliminaractividad_{{ $activity->id }}" tabindex="-1"
        aria-labelledby="eliminaractividadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminaractividadLabel">Eliminar Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta actividad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['agrocefa.activity.delete', 'id' => $activity->id], 'method' => 'POST']) !!}
                    @csrf
                    @method('DELETE')
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    $('.btn-edit-activity').on('click', function(event) {
        var activityId = $(this).data('activity-id');

        // Obtener los datos de la actividad desde algún lugar (puede ser una API, base de datos, etc.)
        var activityData = activitiesData.find(function(activity) {
            return activity.id === activityId;
        });

        // Llenar los campos del formulario con los datos de la actividad
        $('#activity_type_id').val(activityData.activity_type_id);
        $('#name').val(activityData.name);
        $('#description').val(activityData.description);
        $('#period').val(activityData.period);

        // Construir la URL del formulario con el ID de la actividad
        var formAction = '{{ route('agrocefa.activity.edit', ['id' => 'ACTIVITY_ID']) }}';
        formAction = formAction.replace('ACTIVITY_ID', activityId);

        // Actualizar la URL del formulario con el ID de la actividad
        $('#edit-activity-form').attr('action', formAction);
    });

    // Asegúrate de que los datos de las actividades estén disponibles aquí
    var activitiesData = [
        // ... Lista de objetos de actividad con sus propiedades ...
    ];
</script>
