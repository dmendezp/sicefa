<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>¿Desea eliminar el siguiente evento?</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'sica.admin.people.config.event.delete', 'method'=>'POST', 'id'=>'form-config']) !!}
        <div class="modal-body px-4 pt-3" style="font-size: 20px;">
            {!! Form::hidden('id', $event->id) !!}
            <div class="row">
                <div class="col-4 text-right"><b>Nombre: </b></div>
                <div class="col">{{ $event->name }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>Descripción: </b></div>
                <div class="col">{{ $event->description }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>Fecha inicio: </b></div>
                <div class="col">{{ $event->start_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>Fecha cierre: </b></div>
                <div class="col">{{ $event->end_date }}</div>
            </div>
            <div class="row">
                <div class="col-4 text-right"><b>Estado: </b></div>
                <div class="col">
                    @if ($event->state == 'available')
                        Disponible
                    @else
                        Deshabilitado
                    @endif
                </div>
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
