<!-- SweetAlert2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.css')}}">
<!--Sweetalert2 local para utilizar en la plantilla-->
<script  src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js')}}"></script>
<!-- bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>


@if($size > 0 )


<form action="{{route('guardarTurno')}}" method="get">

   <!--  <label for="" class="mt-3"> Asignar Fecha</label>
    <div>
        <input type="date" name="date" id="date" min="{{$fechaActual}}" required>
    </div> -->

    <div class="form-group">
      <label for=""></label>
      <input type="datetime-local" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="" min="{{$fechaActual}}" required>
      <small id="helpId" class="form-text text-muted">Fecha y Hora de Inicio</small>
    </div>

    <div class="form-group">
      <label for=""></label>
      <input type="datetime-local" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="" min="{{$fechaActual}}" required>
      <small id="helpId" class="form-text text-muted">Fecha y Hora de Finalización</small>
    </div>
    

     <div class="">
        <input value="{{$aprendices->first()->Course->code}}-{{$aprendices->first()->Course->Program->name}}"  type="text" name="title" id="title" required multiple style="visibility:hidden">
    </div> 
    
   <!--  Este fragmento ayuda a que se guarde el nombre del curso y codigo como titulo en las asistencias de la base de datos
    para mostrarlo en fullcalendar sin problemas. -->
    
   

    <div>
        <button type="submit" class="btn btn-primary mt-5">Guardar</button>
    </div>

    <div>
        <select name="aprendices[]" id="" class="form-control" multiple style="visibility:hidden">
            @foreach($aprendices as $a)
            <option value="{{$a->id}}" selected>{{$a->id}}</option>
            @endforeach
        </select>
    </div>

</form>


@else

<script>
  
  

  Swal.fire({
  position: 'center',//'top-start','top-end','top-center', 'center-start','center','center-end','bottom','bottom-start','bottom-start'  
  icon: 'error',
  title: '{{$message_result}}',
  showConfirmButton: false,
  timer: 2500
  });
  
  
  
</script>



@endif


