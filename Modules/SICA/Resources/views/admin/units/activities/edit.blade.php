@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>{{trans('sica::menu.Update Quarter')}}</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('sica.admin.units.activities.update', $activity) }}" method="post">
        @csrf
        <div class="card-body pb-1">
            <div class="form-group">
                <label>Nombre:</label>
                {!! Form::text('name', $activity->name, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                <label>Unidad productiva:</label>
                <select name="productive_unit_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($productive_units as $pu)
                        <option value="{{ $pu->id }}" {{ old('productive_unit_id') ? (old('productive_unit_id') == $pu->id ? 'selected' : '') : ($activity->productive_unit_id == $pu->id ? 'selected' : '') }}>{{ $pu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tipo de actividad:</label>
                <select name="activity_type_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($activity_types as $at)
                        <option value="{{ $at->id }}" {{ old('activity_type_id') ? (old('activity_type_id') == $at->id ? 'selected' : '') : ($activity->activity_type_id == $at->id ? 'selected' : '') }}>{{ $at->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                {!! Form::textarea('description', $activity->description, ['class'=>'form-control', 'rows'=>'3', 'required']) !!}
            </div>
            <div class="form-group">
                <label>Periodo:</label>
                {!! Form::text('period', $activity->period, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                <label>Estado:</label>
                {!! Form::select('status', getEnumValues('activities','status'), $activity->status, ['class' => 'form-control', 'placeholder'=>'-- Seleccione --', 'required']) !!}
            </div>
        </div>
        <div class="card-footer py-2 text-right">
            <a href="{{ route('sica.admin.units.activities.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
        </div>
    </form>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>

