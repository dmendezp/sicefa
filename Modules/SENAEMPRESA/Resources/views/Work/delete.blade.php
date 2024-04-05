<div id="content-config"style="padding:2%">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Eliminar Tarea</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form action="{{route('works.destroy')}}" method="post">
        @csrf
        <input type="hidden" value="{{$work->id}}" name="id">
        
        <div class="input-group" >
            <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-keyboard"></i>
                </span>
            </div>
            <input type="text" class="form-control"  name="name" value="{{$work->name}}" readonly>
        </div>
        <small>nombre</small>

        <div class="input-group" style="margin-top:2%">
            <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-keyboard"></i>
                </span>
            </div>
            <input type="text" class="form-control" name="description" value="{{$work->description}}" readonly>
        </div>
        <small>descripción</small>

        <div class="input-group" style="margin-top:2%">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-network-wired"></i>
                </span>
            </div>
            <input type="text" value="{{$work->productive_unit->name}}" class="form-control" name="productive" readonly >
        </div>
        <small>unidad productiva</small>

        
        <div style="mrgin-top:5%">
         <button type="submit" class="btn btn-danger " >Eliminar</button>
        </div>

    </form>
    
</div>

<script>
    $('#form-config').submit(function () { /* Effect for status sending information */
        $('#loader-message').text('Enviando información...'); /* Add content to loader */
        $("#content-config").hide(); /* Hide the content of the modal */
        $('#modal-content').append($('#modal-loader').clone()); /* Add the loader to the modal */
    });
</script>
