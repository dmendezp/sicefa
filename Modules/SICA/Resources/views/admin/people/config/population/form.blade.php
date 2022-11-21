@if (isset($population))
    {!! Form::hidden('id', $population->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($population) ? $population->name : null, ['class' => 'form-control', 'required', 'onkeyup'=>"mayus(this)"]) !!}
</div>
{!! Form::label('description', 'Descripción:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::textarea('description', isset($population) ? $population->description : null, ['class' => 'form-control', 'rows' => 2]) !!}
</div>
