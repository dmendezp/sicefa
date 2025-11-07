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

{!! Form::label('version', trans('sica::menu.Version'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::number('version', isset($program) ? $program->version : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('training_type', trans('sica::menu.Training Type'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('training_type', getEnumValues('programs','training_type'), isset($program) ? $program->training_type : null, ['class' => 'form-control', 'required']) !!}
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

{!! Form::label('quarter_number', trans('sica::menu.Quarter'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::number('quarter_number', isset($program) ? $program->quarter_number : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('knowledge_network_id', trans('sica::menu.Knowledge Network'), ['class' => 'mt-3']) !!}
<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        {!! Form::select('knowledge_network_id', $network, isset($program) ? $program->knowledge_network_id : null, ['class' => 'form-control', 'required']) !!}
    </div>
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

{!! Form::label('maximum_duration', trans('sica::menu.Maximum Duration'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::number('maximum_duration', isset($program) ? $program->maximum_duration : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('months_lectiva', trans('sica::menu.Months Lectiva'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::number('months_lectiva', isset($program) ? $program->months_lectiva : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('months_productiva', trans('sica::menu.Months Productiva'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::number('months_productiva', isset($program) ? $program->months_productiva : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('modality', trans('sica::menu.Modality'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('modality', getEnumValues('programs','modality'), isset($program) ? $program->modality : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('priority_bets', trans('sica::menu.Priority Bets'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('priority_bets', getEnumValues('programs','priority_bets'), isset($program) ? $program->priority_bets : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('fic', trans('FIC'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::select('fic', getEnumValues('programs','fic'), isset($program) ? $program->fic : null, ['class' => 'form-control', 'required']) !!}
</div>
