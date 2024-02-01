
<!--

 @foreach($asistencia as $a)

{{$a}}


@endforeach

-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<table class="table" id="myTable" >
        <thead class="bg-primary thead">
            <tr>
                <th>Nombre</th>
                <th>Tecnologo</th>
                <th>Ficha</th>
                <th>Fecha</th>
                <th>Asistencia</th>
                
            </tr>
        </thead>
        @foreach($asistencia as $asistente)
        
        <tbody>
            <tr>
                <td scope="row">{{$asistente->Person->first_name}} {{$asistente->Person->first_last_name}}</td>
                <td>{{$asistente->Course->Program->name}}</td>
                <td>{{$asistente->Course->code}}</td>
                
                <td>
                @foreach($asistente->asistencias as $a)
                    <div class="mb-3 me-2">{{$a->date}}</div>           
                @endforeach
                </td>
                <td>
                @foreach($asistente->asistencias as $a)
                    <div class="mb-3 me-2"><input data-onstyle="success" data-offstyle="danger" data-on="si" data-off="no" class="toggle-class " type="checkbox" name="asistencia" data-id="{{$a->pivot->id}}"></div>
                @endforeach
                </td>
               
            </tr>
        </tbody>
     
    
        
<!--
        @foreach($asistente->asistencias as $asistencias) 

        {{$asistencias->date}} - {{$asistencias->pivot->asistencia}} - {{$asistencias->guardado}}<br>
        {{$asistencias}}
        @endforeach
       

-->
      
        @endforeach
    </table>
    
     
  
   
         <script>
            $(function () {
            $("#myTable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            
        });
            
        </script>

        
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>