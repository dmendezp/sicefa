<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Actualizar Tipo de compra</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'sica.admin.inventory.parameters.kindOfPurchase.update', 'method'=>'POST', 'id'=>'form-config']) !!}
        <div class="modal-body px-4 pt-0">
            @include('sica::admin.inventory.parameters.kindofpurchase.form')
        </div>
        <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Actualizar', ['class'=>'btn btn-success btn-md py-0']) !!}
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
