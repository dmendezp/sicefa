<div id="content-config">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>¿Desea eliminar la siguiente titulada?</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {!! Form::open(['route'=>'sica.admin.academy.course.destroy', 'method'=>'POST', 'id'=>'form-config']) !!}
        <div class="modal-body px-4 pt-3" style="font-size: 20px;">
            {!! Form::hidden('id', $course->id) !!}
            <div class="row">
                <div class="col-6 text-right"><b>Código: </b></div>
                <div class="col">{{ $course->code }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>Nombre del programa: </b></div>
                <div class="col">{{ $course->program->name }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>Fecha de inicio: </b></div>
                <div class="col">{{ $course->star_date }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>Fecha de fin: </b></div>
                <div class="col">{{ $course->end_date }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>Estado: </b></div>
                <div class="col">{{ $course->status }}</div>
            </div>
            <div class="row">
                <div class="col-6 text-right"><b>Dia Descolarizado: </b></div>
                <div class="col">{{ $course->deschooling }}</div>
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