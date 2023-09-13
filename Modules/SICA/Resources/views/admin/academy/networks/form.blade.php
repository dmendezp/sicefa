@if (isset($network))
    {!! Form::hidden('id', $network->id) !!}
@endif
{!! Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($network) ? $network->name : null, ['class' => 'form-control', 'required']) !!}
</div>
{!! Form::label('line_id', trans('sica::menu.Technological line'), ['class' => 'mt-3']) !!}
<div class="form-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-list"></i>
        </span>
        {!! Form::select('line_id', $lines, isset($network) ? $network->line_id : null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>