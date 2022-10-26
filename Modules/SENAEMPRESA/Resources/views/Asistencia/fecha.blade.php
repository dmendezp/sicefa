

    
    <table class="table" id="myTable">
        <thead class="bg-primary">
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
                <td>1</td>
                <td>2</td>
            </tr>
        </tbody>
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

        
      