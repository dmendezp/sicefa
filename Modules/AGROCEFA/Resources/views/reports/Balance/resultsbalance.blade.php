@if (!empty($filteredLabors) && count($filteredLabors) > 0)
    <div class="card">
        <div class="card-header">
            {{ trans('agrocefa::balance.labors') }}
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('agrocefa::balance.activity') }}</th>
                        <th>{{ trans('agrocefa::balance.activitytype') }}</th>
                        <th>{{ trans('agrocefa::balance.executiondate') }}</th>
                        <th>{{ trans('agrocefa::balance.laborexpense') }}</th>
                        <th>{{ trans('agrocefa::balance.Productionprice') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredLabors as $labor)
                        <tr>
                            <td>{{ $labor->activity->name }}</td>
                            <td>{{ $labor->activity->activity_type->name }}</td>
                            <td>{{ $labor->execution_date }}</td>
                            <td>{{ $labor->price }}</td>
                            <td>
                                @if ($labor->activity->activity_type->name === 'Producción')
                                    @if (!is_null($labor->totalProductionPrice) && $labor->totalProductionPrice > 0)
                                        {{ $labor->totalProductionPrice }}
                                    @else
                                        {{ trans('agrocefa::balance.There_is_no_registered_production') }}
                                    @endif
                                @else
                                    {{ trans('agrocefa::balance.Does_not_have_production') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                        <td><strong>{{ trans('agrocefa::balance.Totalexpenses') }}:</strong></td>
                        </td>
                        <td><strong>{{ $totalExpenses }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        <td><strong>{{ trans('agrocefa::balance.TotalProductions') }}:</strong></td>
                        </td>
                        <td><strong>{{ $totalProductions }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a id="pdf" href="{{ route('agrocefa.reports.balancepdf') }}" class="btn btn-danger" target="_blank">{{ trans('agrocefa::balance.export') }} <i class="fa-solid fa-file-pdf"></i></a>
        <br>
    </div>


    <div class="card mt-4">
        <div class="card-header">
            {{ trans('agrocefa::balance.TotalsChart') }}
        </div>
        <div class="card-body">
            <div id="highcharts-container"></div>
        </div>
    </div>
@else
    <br>
    @if (isset($no_found))
        <p>{{ $no_found }}</p>
    @endif  
@endif

<style>
    #pdf{
        width: 14%;
        margin: 0 auto;
        display: inline-block;
        text-align: center;
    }
</style>


<script>
    // Obtén los totales de gastos y producciones de tu PHP
    var totalExpenses = {{ $totalExpenses }};
    var totalProductions = {{ $totalProductions }};

    // Configura la gráfica con Highcharts
    Highcharts.chart('highcharts-container', {
        chart: {
            type: 'column' // Tipo de gráfica de columnas
        },
        title: {
            text: '{{ trans('agrocefa::balance.TotalExpensesroductions') }}'
        },
        xAxis: {
            categories: ['{{ trans('agrocefa::balance.expenses') }}',
                '{{ trans('agrocefa::balance.productions') }}'
            ]
        },
        yAxis: {
            title: {
                text: '{{ trans('agrocefa::balance.values') }}'
            }
        },
        series: [{
            name: '{{ trans('agrocefa::balance.values') }}',
            data: [totalExpenses, totalProductions]
        }]
    });
</script>
