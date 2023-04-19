@if (isset($c))
    {!! Form::hidden('id', $c->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($c) ? $c->name : null, ['class' => 'form-control', 'required', 'onkeyup'=>"mayus(this)"]) !!}
</div>

{!! Form::label('kind_of_property', 'Tipo de Propiedad:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('kind_of_property', isset($c) ? $c->kind_of_property : null, ['class' => 'form-control', 'required', 'onkeyup'=>"mayus(this)"]) !!}
</div>
