@if (isset($line))
    {!! Form::hidden('id', $line->id) !!}
@endif
{!! Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($line) ? $line->name : null, ['class' => 'form-control', 'required']) !!}
</div>

