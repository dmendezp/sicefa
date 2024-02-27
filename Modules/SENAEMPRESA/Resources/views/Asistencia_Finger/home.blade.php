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

<!-- Elemento <div> para mostrar la suma condicional -->
<!-- <div id="conditionalSumDisplay"></div> -->

@endsection

@section('scripts')
<script>

    @if (Session::get('success'))

        /* Show the message */
       
            toastr.success("{{ Session::get('success') }}");      
        
    @endif


    $(function () {
                var table = $("#table").DataTable({

                "responsive": true,
                "autoWidth": false,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                dom: 'Bfrtip',
                buttons: [
                    /* 'copy', 'csv',  */'excel', 'pdf'/* , 'print' */
                ],

                });

                // Condición para resaltar celdas 
                table.cells().every(function() {
                    var data = this.data();
                    if (parseInt(data) == 0 || (parseInt(data) > 8 && parseInt(data) <= 10) ) {
                        $(this.node()).css('background-color', '#F0C215').css('color', 'red');
                    }else if (parseInt(data) > 0 && parseInt(data) <= 8 ){
                        $(this.node())/* .css('background-color', '#237286') */.css('color', '#237286');
                    }
                });

                // Condición para resaltar filas 
                table.rows().every(function() {
                    var rowData = this.data();
                    var horas = parseInt(rowData[6]); // Considerando que la columna "Age" está en el índice 1
                    if (horas == 0) {
                        $(this.node()).addClass('dark');
                    }
                    else if(horas > 0 || horas < 9){
                        $(this.node()).addClass('dark');
                    }
                });


                // Suma condicional de la columna "Salary" para personas mayores de 25 años
                /* var conditionalSum = 0;
                table.rows().every(function() {
                    var rowData = this.data();
                    var age = parseInt(rowData[6]); // Considerando que la columna "Age" está en el índice 1
                    var salary = parseInt(rowData[6]); // Considerando que la columna "Salary" está en el índice 2
                    if (age > 0) {
                    conditionalSum += salary;
                    }
                });

                // Muestra la suma condicional en el elemento <div>
                $("#conditionalSumDisplay").text("Suma condicional de la columna Salary para personas mayores de 25 años: " + conditionalSum); */

           
        });

        
</script>


<style>

    .dark{
        cursor: pointer;
        transition: 0.3s;
    }
    .dark:hover{
        transform: scale(1.06);
        transition: 0.3s;
    }
</style>


@endsection