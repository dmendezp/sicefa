<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>{{ $titleView }}</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'cpd.admin.producer.destroy', 'method'=>'POST', 'id'=>'form-producer']) !!}
        <div class="modal-body px-4 py-0">
            @include('cpd::producer.form')
            <p class="mt-3 bg-light text-center">
                Monitoreos asociados: <b>{{ $producer->studies->count() }}</b>
            </p>
            @if ($producer->studies->count() > 0)
                <div class="alert py-1" role="alert" style="background-color: rgb(251, 209, 216); font-size: 14px;">
                    <b>Los monitores asociados también serán eliminados.</b>
                </div>
            @endif
        </div>
        <div class="modal-footer py-1">
            <button type="button" class="btn btn-secondary btn-md py-0" data-dismiss="modal">Cancelar</button>
            {!! Form::submit('Eliminar', ['class'=>'btn btn-danger btn-md py-0']) !!}
        </div>
    {!! Form::close() !!}
</div>

<script>
    $('#form-producer').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });

    document.getElementById('name').readOnly=true; /* Disable name text field from form.blade.php */
</script>
