



<form action="{{route('guardarTurno')}}" method="get">

<label for="" class="mt-3"> Asignar Fecha</label>
<div>
<input type="date" name="date"  id="date">
</div>
<div>
<button type="submit" class="btn btn-primary mt-5">Guardar</button>
</div>

<div>
<select name="aprendices[]" id="" class="form-control" multiple  style="visibility:hidden" >
@foreach($aprendices as $a)
    <option value="{{$a->id}}"  selected >{{$a->id}}</option>
@endforeach
    </select>
</div>

</form>



    @foreach($aprendices as $a)
    {{$a->id}}
    {{$a->CodeCurso}}
    @endforeach
