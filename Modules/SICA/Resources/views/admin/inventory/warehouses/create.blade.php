@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>{{trans('sica::menu.Add Warehouse')}}</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('sica.admin.inventory.warehouse.store') }}" method="post">
        @csrf
        <div class="card-body pb-1">
            <div class="form-group">
                <label>Nombre:</label>
                {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'3', 'required']) !!}
            </div>
            <div class="form-group">
                <label>Aplicación:</label>
                <select name="app_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($apps as $app)
                        <option value="{{ $app->id }}" {{ old('app_id') == $app->id ? 'selected' : '' }}>{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer py-2 text-right">
            <a href="{{ route('sica.admin.inventory.warehouse.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
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

