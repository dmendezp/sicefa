@extends('senaempresa::layouts.master')

@section('content')


<div class="col">
<div class="card card-outline card-primary">
<div class="card-header">
<h3 class="card-title">Primary Card Example</h3>

<div>

  


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#exampleModal">
  Asignar Turno Rutinario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="" role="" aria-labelledby="exampleModalLabel" aria-hidden="">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <label for="">Titulaciones</label>  
        <div class="mb-4">
          <select class="curso form-control" name="course_id" id="course_" required>
          <option value="" >Seleccione...</option>
          @foreach($courses as $cursos)
          <option value="{{$cursos->id}}">{{$cursos->code}}-{{$cursos->Program->name}}</option>
          @endforeach
          </select>
          </div>

          <div id="divAprendices">
          

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      
    </div>
  </div>
</div>
          


  
  </div>
</div>
<div class="form-group">
<div class="card-body">

  <select class="form-control cursos" name="course_id" id="course_id" required>
    <option value="" >Seleccione...</option>
    @foreach($courses as $cursos)
    <option value="{{$cursos->id}}">{{$cursos->code}}-{{$cursos->Program->name}}</option>
    @endforeach
  </select>
  

  </div>
 

    {{--este div mostrará todos los aprendices relacionados con el id del curso--}}
    <div id="divAsistencias" class="mt-4">

      


    </div>

</div>
<div class="card-footer">
The footer of the card
</div>
</div>
</div>

@endsection

@section('scripts')
<script>

$(document).ready(function() {
    $('.cursos').select2();
    
});


$(document).on("change","#course_id", function(){  //change se utiliza para saber si hay cambios en el section "click" se puede utilizar cuando se da click en un boton
        //alert($(this).val());  //la función de val me trae el id de los cursos para traer todos los datos relacionados y este es un alert para mostrar el id; también se puede colocar alert('mensaje'); para saber si entró a la función.

        
        //inicio del ajax

         $.ajaxSetup({
           headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
           }
         });
         $.ajax({
           method: "get",
           url: '{{url("")}}/senaempresa/TurnoRutinario/buscarLista/'+$(this).val(),
           data: {}
         })
         .done(function(html){
           $("#divAsistencias").html(html);
         })

        //fin del ajax
      });



</script>         
           
          <!-- ajax para traer el id de los aprendices -->
          <script>
             $.ajaxSetup({
            headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
               }
              });
            $(document).on("change","#course_", function(){  //change se utiliza para saber si hay cambios en el section "click" se puede utilizar cuando se da click en un boton
            //alert($(this).val());  //la función de val me trae el id de los cursos para traer todos los datos relacionados y este es un alert para mostrar el id; también se puede colocar alert('mensaje'); para saber si entró a la función.

        
              //inicio del ajax

              $.ajaxSetup({
                headers:{
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                method: "get",
                url: 'http://cisefa.test/sicefa/public/senaempresa/TurnoRutinario/Guardar/'+$(this).val(),
                data: {}
              })
              .done(function(html){
                $("#divAprendices").html(html);
              })

              //fin del ajax
            });
          </script>
          
          <!-- select2 --> 
            <script>
            $(document).ready(function() {
                $('.curso').select2();
            });
            
            </script>
            @endsection
        

            

      </div>


      
   