@if (isset($movement_type))
    {!! Form::hidden('id', $movement_type->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($movement_type) ? $movement_type->name : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('consecutive', 'Consecutive:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('consecutive', isset($movement_type) ? $movement_type->consecutive : null, ['class' => 'form-control', 'required']) !!}
</div>
