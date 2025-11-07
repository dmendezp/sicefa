@extends('senaempresa::layouts.master')

@section('content')
<div id="container" style="margin-left:2%;margin-right:2%">
    <div id="calendar"></div>
</div>



<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

            <form action="" >
                @csrf
                
                <div class="form-group">
                  <label for="course_id">Curso</label>
                  <select class="form-control" name="course_id" id="course_id">
                    @foreach($cursos as $curso)
                    <option value="{{$curso->id}}">{{$curso->code}}-{{$curso->Program->name}}</option>
                    @endforeach
                    
                  </select>
                </div>

                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>

                <div class="form-group">
                  <label for="description">Ingresa la actividad a desarrollar</label>
                  <input type="datetime-local" name="description" id="description" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>

                <div class="form-group">
                  <label for="start">start</label>
                  <input type="datetime-local" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>

                <div class="form-group">
                  <label for="end">end</label>
                  <input type="text" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>

                </form>

            </div>
            <div class="modal-footer">
<!-- 
            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
            <button type="button" class="btn btn-success"  id="btnModificar">Modificar</button>
            <button type="button" class="btn btn-primary"  id="btnGuardar">Guardar</button> -->

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {

    let formulario = document.querySelector("form");

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:'es',/*  mostrar calendario en español */

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek'
        }, /* seccion que muestra el calendario por mes, semana, y evento */

        events: "{{url('')}}/senaempresa/TurnoRutinario/calendarTurn/show",

        /* dateClick:function(info){


          $("#evento").modal("show");
        } */
    });
    calendar.render();

    document.getElementById("btnGuardar").addEventListener("click",function(){

        const datos= new FormData(formulario);
        console.log(datos); 
       /*  console.log(formulario.title.value); */

        axios.post("{{url('')}}/senaempresa/TurnoRutinario/calendarTurn/create", datos).
        then(
          (respuesta) =>{
            $("#evento").modal("hide");
          }
        ).catch(
          error=>{
            if(error.reponse){
              console.log(error.response.data);
            }
          }
        )
        

    });
});
</script>

@endsection