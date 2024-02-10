<label for="name" id="divMunicipality">Ciudad Donde Se Dirige:</label>

<div class="input -group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">
            <i class="far fa-keyboard"></i>
        </span>
    </div>
    {!!Form::select('municipality_id',$municipality,null,['class'=>'form-control','placeholder'=>'---Seleccione---', 'id'=>'municipality'])!!}
</div>