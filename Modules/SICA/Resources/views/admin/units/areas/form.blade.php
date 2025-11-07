@if (isset($area))
    {!! Form::hidden('id', $area->id) !!}
@endif

{!! Form::label('name', trans('sica::menu.Name'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::text('name', isset($area) ? $area->name : null, ['class' => 'form-control', 'required']) !!}
</div>

{!! Form::label('description', trans('sica::menu.Description'), ['class' => 'mt-3']) !!}
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!! Form::textarea('description', isset($area) ? $area->description : null, ['class' => 'form-control', 'required']) !!}
</div>
