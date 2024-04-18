<div id="content-config"style="padding:2%">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Crear Tarea</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form action="{{route('work.store')}}" method="post">
        @csrf
        
        <div class="input-group" >
            <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-keyboard"></i>
                </span>
            </div>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Nombre...">
        </div>
        <small>Escriba nombre</small>

        <div class="input-group" style="margin-top:2%">
            <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-keyboard"></i>
                </span>
            </div>
            <input type="text" class="form-control" name="description" placeholder="Descripción..." rows="3">
        </div>
        <small>Escriba descripción</small>

        <div class="input-group" style="margin-top:2%">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-network-wired"></i>
                </span>
            </div>
            <select name="productive" id=""class="form-control">
                @foreach($productive_units as $productive)
                    <option value="{{$productive->id}}">{{$productive->name}}</option>
                @endforeach
            </select>
        </div>
        <small>Selecionar unidad</small>

        
        <div style="mrgin-top:5%">
         <button type="submit" class="btn btn-primary thead " >Guardar</button>
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
