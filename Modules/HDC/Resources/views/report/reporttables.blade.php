<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-body">
                <h3 class="text-center font-weight-bold">{{ trans('Reporte Huella de Carbono') }}</h3>
                <table class="table table-bordered custom-table-style">
                    <thead>
                        <tr>
                            <th>{{ trans('hdc::report.Sector_Column') }}</th>
                            <th>Unidad Productiva</th>
                            <th>Huella de Carbono</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCarbonBySector = [];
                            $groupedAspects = collect($aspectosAmbientales)->groupBy('sector_name');
                        @endphp

                        @foreach ($groupedAspects as $sectorName => $aspects)
                                {{-- Muestra el nombre del sector solo una vez --}}
                                <tr>
                                    <td rowspan="{{ count($aspects) }}">{{ $sectorName }}</td>
                                    <td>{{ $aspects[0]['productive_unit_name'] }}</td>
                                    <td>{{ $aspects[0]['carbon_footprint'] }}</td>
                                    <td rowspan="{{ count($aspects) }}">
                                        @php
                                            // Suma los carbon_footprint de cada aspecto para el total del sector
                                            $totalCarbonBySector[$sectorName] = $aspects->sum('carbon_footprint');
                                            echo $totalCarbonBySector[$sectorName];
                                        @endphp
                                    </td> 
                                </tr>

                                @for ($i = 1; $i < count($aspects); $i++)
                                    {{-- Verifica si hay carbon_footprint antes de mostrar la fila --}}
                                    @if ($aspects[$i]['carbon_footprint'] > 0)
                                        <tr>
                                            <td>{{ $aspects[$i]['productive_unit_name'] }}</td>
                                            <td>{{ $aspects[$i]['carbon_footprint'] }}</td>
                                        </tr>
                                    @endif
                                @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
