@extends('senaempresa::layouts.master')

@section('content')



<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('fingerPrint.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset(Auth::user()->id))
                <input type="hidden" value="{{Auth::user()->id}}" name="id_user">
                @endif
                <div class="form-group">
                    <label for=""> </label>
                    <input type="file" class="form-control-file " name="file" id="" placeholder=""
                        aria-describedby="fileHelpId">
                    <small id="fileHelpId" class="form-text text-muted">Anexa tu archivo</small>
                </div>
                <button type="submit" class="btn text-light" style="background-color:blue" >Importar</button>
            </form>

        </div>
    </div>
</div>

<div class="container" style="margin-top:4%">
    <table class="table" id="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Area</th>
                <th>Fecha del turno</th>
                <th>Hora de ingreso</th>
                <th>Hora de salida</th>
                <th>Horas trabajadas</th>
            </tr>
        </thead>
        <tbody>
        @foreach($asistencia as $a)
            <tr>
                <td>{{$a->person->first_name}} {{$a->person->first_last_name}}</td>
                <td>{{$a->person->document_number}}</td>
                <td>{{$a->area}}</td>
                <td>{{$a->date_turn}}</td>
                <td>{{$a->time_in}}</td>
                <td>{{$a->time_exit}}</td>
                <td>{{$a->hours_work}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


@endsection

@section('scripts')
<script>
    $(function () {
            $("#table").DataTable({
                "responsive": true,
                "autoWidth": false,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
            });
            
           
        });
</script>
@endsection