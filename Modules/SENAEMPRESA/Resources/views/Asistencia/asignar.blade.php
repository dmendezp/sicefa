<!-- SweetAlert2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.css')}}">
<!--Sweetalert2 local para utilizar en la plantilla-->
<script  src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.js')}}"></script>

@if($size > 0 )



<form action="{{route('guardarTurno')}}" method="get">

    <label for="" class="mt-3"> Asignar Fecha</label>
    <div>
        <input type="date" name="date" id="date" required>
    </div>
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
{{$size}}<br>
@foreach($aprendices as $a)
{{$a->id}}
{{$a->CodeCurso}}
@endforeach

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


