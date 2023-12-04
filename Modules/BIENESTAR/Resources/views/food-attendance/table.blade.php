<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>                                
                                <th>Porcentaje</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $resultadoss as $rel )
                            <tr>
                                <td>{{$rel->document_number}}</td>
                                <td>{{$rel->first_name}} {{$rel->first_last_name}} {{$rel->second_last_name}}</td>
                                <td>{{$rel->porcentaje}}</td>
                                <td>{{$rel->date_time}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>