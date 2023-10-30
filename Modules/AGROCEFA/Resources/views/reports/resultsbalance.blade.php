@if (!empty($filteredLabors) && count($filteredLabors) > 0)
    <div class="card">
        <div class="card-header">
            Labores
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Actividad</th>
                        <th>Tipo de Actividad</th>
                        <th>Fecha de ejecucion</th>
                        <th>Precio labor</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredLabors as $labor)
                        <tr>
                            <td>{{ $labor->activity->name }}</td>
                            <td>{{ $labor->activity->activity_type->name }}</td>
                            <td>{{ $labor->execution_date }}</td>
                            <td>{{ $labor->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
<br>
    <p>No se encontraron labores del cultivo seleccionado</p>
@endif
