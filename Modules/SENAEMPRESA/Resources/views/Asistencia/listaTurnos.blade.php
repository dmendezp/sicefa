@extends('senaempresa::layouts.master')

@section('content')



<!--{{$asistencias}}<br> -->




<div class="card card-outline card-primary me-1 ms-1">
<div class="card-header">
<h3 class="card-title">Primary Outline</h3>
<div class="card-tools">
<button type="button" class="btn btn-tool" data-card-widget="collapse">
<i class="fas fa-minus"></i>
</button>
</div>

</div>

<div class="card-body">

<table class="table " id="Table_Turnos">
    <thead class="thead">
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Programa</th>
            <th>Ficha</th>
        </tr>
    </thead>
    <tbody>
    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
    @foreach($asistencias as $asistente)
        <tr>
            <td scope="row">{{$asistente->id}}</td>
            <td>
                <form action="{{route('updateTurno')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $asistente->id }}">
                    <input type="date" name="date" id="" value="{{$asistente->date}}">
                    <button type="submit" class="btn btn-outline-success btn-sm" name="" id=""  placeholder="">
                    <i class="far fa-edit"></i>
                    </button>
                </form>
           

                
               
            </td>
            <td>{{$asistente->apprentices->first()->Course->Program->name}}</td>
            <td>{{$asistente->apprentices->first()->CodeCurso}}</td>
        </tr>
    @endforeach 
    </tbody>
</table>

</div>

</div>





@endsection

@section('dataTables')
    <script type="text/javascript">
    $(document).ready( function (){
        $('#Table_Turnos').DataTable({
            "responsive": true,
            "autoWidth": false,
          });
    });
    </script>
@endsection

