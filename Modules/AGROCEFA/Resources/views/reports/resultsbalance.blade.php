@if (isset($filteredLabors) && $filteredLabors->count() > 0)
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredLabors as $labor)
                <tr>
                    <td>{{ $labor->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No se encontraron labores en el rango de fechas seleccionado.</p>
@endif
