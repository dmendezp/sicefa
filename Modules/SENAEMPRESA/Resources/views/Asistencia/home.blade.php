@extends('senaempresa::layouts.master')

@section('content')


<div class="col">
<div class="card card-outline card-primary " style="padding-left:1%; padding-right:1%">
<div class="card-header">
<h3 class="card-title">Primary Card Example</h3>

<div>

@if(Auth::user()->havePermission('senaempresa.listaTurnos'))
<a name="" id="" class="btn btn-success float-right thead" style="margin-left:0.3%" href="{{route('listaTurnos')}}" role="button">Asignar y ver turnos</a>

@endif

  
  </div>
</div>
<div class="form-group">
<div class="card-body">

  <select class="form-group col-md-10 curso" name="course_id" id="course_id" required>
    <option value="" >Seleccione...</option>
    @foreach($asistencias as $asistencia)
    <option value="{{$asistencia->id}}">{{$asistencia->title}} - {{$asistencia->start}}</option>
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

</div>

@endsection

@section('scripts')

  <!-- select2 --> 
  <script>
            $(document).ready(function() {
                $('.curso').select2();
            });
            
            </script>
<script>




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

<script>
  select {
    appearance: none;
    padding: 15px 20px;
    -webkit-border-radius: 150px;
    -moz-border-radius: 150px;
    border-radius: 150px;
    border: 1px solid green;
    background-color: green;
    color: #ffffff;
    font-size: 18px;
}


</script>

<script>
  @if ($messages = Session::get('message_result'))
  

  Swal.fire({
  position: 'center',//'top-start','top-end','top-center', 'center-start','center','center-end','bottom','bottom-start','bottom-start'
    
  @if (Session::get('icon')=='success')
  icon: 'success',
  @elseif(Session::get('icon')=='error')
  icon: 'error',
  @endif
  title: '{{$messages}}',
  showConfirmButton: false,
  timer: 3500
  });
  
  
  @endif
</script>

@endsection
        

            
           
     


      
   