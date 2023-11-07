<div class="row">
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-body">
                <h3 class="text-center font-weight-bold">{{ trans('hdc::report.Report_Indicator') }}</h3>
                <table class="table table-bordered custom-table-style" id="datatable">
                    <thead>
                        <tr>
                            <th>{{ trans('hdc::report.Sector_Column') }}</th>
                            <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_productive_unit')}}</th>
                            <th>{{ trans('hdc::report.Carbon_Footprint_Column') }}</th>
                            <th>{{ trans('hdc::report.Title_Column_Total') }}</th>
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
                                <td>{{ number_format($aspects[0]['carbon_footprint'], 2) }}</td>
                                <td rowspan="{{ count($aspects) }}">
                                    @php
                                        // Suma los carbon_footprint de cada aspecto para el total del sector
                                        $totalCarbonBySector[$sectorName] = $aspects->sum('carbon_footprint');
                                        echo number_format($totalCarbonBySector[$sectorName], 2);
                                    @endphp
                                </td>
                            </tr>

                            @for ($i = 1; $i < count($aspects); $i++)
                                {{-- Verifica si hay carbon_footprint antes de mostrar la fila --}}
                                @if ($aspects[$i]['carbon_footprint'] > 0)
                                    <tr>
                                        <td>{{ $aspects[$i]['productive_unit_name'] }}</td>
                                        <td>{{ number_format($aspects[$i]['carbon_footprint'], 2) }}</td>
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
