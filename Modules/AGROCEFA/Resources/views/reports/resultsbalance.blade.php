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
                        <th>Fecha de ejecución</th>
                        <th>Precio de labor</th>
                        <th>Precio de la producción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredLabors as $labor)
                        <tr>
                            <td>{{ $labor->activity->name }}</td>
                            <td>{{ $labor->activity->activity_type->name }}</td>
                            <td>{{ $labor->execution_date }}</td>
                            <td>{{ $labor->price }}</td>
                            @if ($labor->activity->activity_type->name === 'Producción')
                                <td>
                                    @if (!is_null($labor->totalProductionPrice) && $labor->totalProductionPrice > 0)
                                        {{ $labor->totalProductionPrice }}
                                    @else
                                        No hay producción registrada
                                    @endif
                                </td>
                            @else
                                <td>No cuenta con produccion</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Totales
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Total de Gastos: {{ $totalExpenses }}</h4>
                </div>
                <div class="col-md-6">
                    <h4>Total de Producciones: {{ $totalProductions }}</h4>
                </div>
            </div>
        </div>
    </div>
@else
    <br>
    <p>No se encontraron labores del cultivo seleccionado</p>
@endif

