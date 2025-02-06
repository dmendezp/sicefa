<div id="content-config"style="padding:2%">
    <div class="modal-header py-2">
        <h5 class="modal-title" id="exampleModalLabel">
            <b>Editar Tarea</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form action="{{route('works.edit')}}" method="post">
        @csrf

        <input type="hidden" value="{{$work->id}}" name="id">
        
        <div class="input-group" >
            <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-keyboard"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="{{$work->name}}" name="name" placeholder="Nombre...">
        </div>
        <small>Escriba nombre</small>

        <div class="input-group" style="margin-top:2%">
            <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-keyboard"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="{{$work->description}}" name="description" placeholder="Descripción..." rows="3">
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
                    @if($work->productive_unit_id == $productive->id)
                    <option value="{{$productive->id}}" selected>{{$productive->name}}</option>
                    @else
                    <option value="{{$productive->id}}">{{$productive->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <small>Selecionar unidad</small>

        
        <div style="mrgin-top:5%">
         <button type="submit" class="btn btn-primary thead " >Actualizar</button>
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