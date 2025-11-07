<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>¿Desea eliminar la siguiente Unidad de Medida?</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'sica.admin.inventory.parameters.measurementUnit.destroy', 'method'=>'POST', 'id'=>'form-config']) !!}
        <div class="modal-body px-4 pt-3" style="font-size: 20px;">
            {!! Form::hidden('id', $measurementUnit->id) !!}
            <div class="row">
                <div class="col-6 text-right"><b>Nombre: </b></div>
                <div class="col">{{ $measurementUnit->name }}</div>
                <div class="col-6 text-right"><b>Abreviación: </b></div>
                <div class="col">{{ $measurementUnit->abbreviation }}</div>
                <div class="col-6 text-right"><b>Medida unitaria minima: </b></div>
                <div class="col">{{ $measurementUnit->minimum_unit_measure }}</div>
                <div class="col-6 text-right"><b>Factor de converción: </b></div>
                <div class="col">{{ $measurementUnit->conversion_factor }}</div>
            </div>
        </div>
        <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Eliminar', ['class'=>'btn btn-danger btn-md py-0']) !!}
        </div>
    {!! Form::close() !!}
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
