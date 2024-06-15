@if (isset($knowledgenetworks))
    {!! Form::hidden('id', $knowledgenetworks->id) !!}
@endif
{!! Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($knowledgenetworks) ? $knowledgenetworks->name : null, ['class' => 'form-control', 'required']) !!}
</div>
{!! Form::label('network_id', trans('sica::menu.Network'), ['class' => 'mt-3']) !!}
<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        {!! Form::select('network_id', $networks, isset($knowledgenetworks) ? $knowledgenetworks->line_id : null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>