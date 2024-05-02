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
    <form action="{{ route('sica.'.$role_name.'.academy.quarters.update', $quarter) }}" method="post">
        @csrf
        <div class="card-body pb-1">
            <div class="form-group">
                <label>{{trans('sica::menu.Name')}}:</label>
                {!! Form::text('name', $quarter->name, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                <label>{{trans('sica::menu.Start Date')}}:</label>
                {!! Form::date('start_date', $quarter->start_date, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                <label>{{trans('sica::menu.End Date')}}:</label>
                {!! Form::date('end_date', $quarter->end_date, ['class'=>'form-control', 'required']) !!}
            </div>
        </div>
        <div class="card-footer py-2 text-right">
            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.quarters.index'))
                <a href="{{ route('sica.admin.academy.quarters.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
            @endif
            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.quarters.update'))
                <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
            @endif
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

