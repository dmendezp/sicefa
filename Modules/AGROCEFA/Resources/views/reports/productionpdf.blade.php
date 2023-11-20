<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF PRODUCCION</title>
</head>

<body>
    <h1 style="text-align: center">Reporte produccion</h1>
    <br>
    <table id="example1" style="text-align: center" class="table table-bordered table-striped">
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
            <br>
            <h2 style="text-align: center">Totales</h2>
            <tr style="text-align: left">
                <td>
                <td><strong>{{ trans('agrocefa::balance.Totalexpenses') }}:</strong></td>
                </td>
                <td><strong>{{ $totalExpenses }}</strong></td>
            </tr>
            <tr style="text-align: left">
                <td>
                <td><strong>{{ trans('agrocefa::balance.TotalProductions') }}:</strong></td>
                </td>
                <td><strong>{{ $totalProductions }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
