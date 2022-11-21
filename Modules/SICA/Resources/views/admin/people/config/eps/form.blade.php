@if (isset($eps))
    {!! Form::hidden('id', $eps->id) !!}
@endif
{!! Form::label('name', 'Nombre:', ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($eps) ? $eps->name : null, ['class' => 'form-control', 'required', 'onkeyup'=>"mayus(this)"]) !!}
</div>
