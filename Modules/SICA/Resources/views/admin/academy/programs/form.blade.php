@if (isset($program))
    {!! Form::hidden('id', $program->id) !!}
@endif


{!! Form::label('sofia_code', trans('sica::menu.Code'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('sofia_code', isset($program) ? $program->sofia_code : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('program_type', trans('sica::menu.Type'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('program_type', getEnumValues('programs','program_type'), isset($program) ? $program->program_type : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($program) ? $program->name : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('network_id', trans('sica::menu.Knowledge Network'), ['class' => 'mt-3']) !!}
<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        {!! Form::select('network_id', $network, isset($program) ? $program->network_id : null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>