@if (isset($elements))
    {!! Form::hidden('id', $elements->id) !!}
@endif
<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Agregar Tipo de Compra</b>
        </h5>
    </div>
        <div class="modal-body px-4 pt-0">
            <h1>holaaa</h1>
        </div>
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
