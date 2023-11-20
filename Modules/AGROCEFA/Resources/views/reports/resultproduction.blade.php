@if (!empty($filteredproduction) && count($filteredproduction) > 0)
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Tipo de Actividad</th>
                <th>Fecha de producción</th>
                <th>Precio labor</th>
                <th>Destino</th>
                <th>Tipo de Cultivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredproduction as $production)
                <tr>
                    <td>{{ $production->activity->name }}</td>
                    <td>{{ $production->activity->activity_type->name }}</td>
                    <td>{{ $production->production_date }}</td>
                    <td>{{ $production->price }}</td>
                    <td>{{ $production->destination }}</td>
                    <td>{{ $production->crop->tipo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay datos de producción para la selección actual.</p>
@endif
