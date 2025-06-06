@php
    $role_name = getRoleRouteName(Route::currentRouteName()); // Obtener el rol a partir del nombre de la ruta en la cual ha sido invocada esta vista
@endphp

<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>{{trans('sica::menu.Do you want to delete the following title?')}}</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'sica.'.$role_name.'.academy.courses.destroy', 'method'=>'POST', 'id'=>'form-config']) !!}
        <div class="modal-body px-4 pt-3" style="font-size: 20px;">
            {!! Form::hidden('id', $course->id) !!}
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Fiche')}}</b></div>
                <div class="col-8">{{ $course->code }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Name')}}</b></div>
                <div class="col-8">{{ $course->program->name }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Leading Instructor')}}</b></div>
                <div class="col-8">{{ $course->person->full_name }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Start Date')}}</b></div>
                <div class="col-8">{{ $course->star_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.End Of School Year')}}</b></div>
                <div class="col-8">{{ $course->school_end_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Start Productive')}}</b></div>
                <div class="col-8">{{ $course->star_production_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.End Date')}}</b></div>
                <div class="col-8">{{ $course->end_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Status')}}</b></div>
                <div class="col-8">{{ $course->status }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>{{trans('sica::menu.Modality')}}</b></div>
                <div class="col-8">{{ $course->deschooling }}</div>
            </div>
        </div>
        <div class="modal-footer py-1">
            <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">{{trans('sica::menu.Cancel')}}</button>
            @if (Auth::user()->havePermission('sica.'.$role_name.'.academy.courses.destroy'))
                {!! Form::submit(trans('sica::menu.Delete'), ['class'=>'btn btn-danger btn-md py-0']) !!}
            @endif
        </div>
    {!! Form::close() !!}
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
