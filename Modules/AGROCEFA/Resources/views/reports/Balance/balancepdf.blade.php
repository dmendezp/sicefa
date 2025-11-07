<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF BALANCE</title>

    <style>
        body {
            font-family: 'Arial, sans-serif';
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            /* Centra la tabla */
            margin-top: 20px;
            /* Ajusta el margen superior de la tabla */
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 12px;
            /* Ajusta el espaciado interno de las celdas */
        }

        th {
            background-color: rgb(135, 186, 206);
            color: black;
        }

        #Total {
            background-color: rgb(135, 186, 206);
        }

        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        h1,
        h2 {
            text-align: center;
        }

        img {
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <br>
    <h1>{{ trans('agrocefa::balance.balancereport') }}</h1>
    <table class="table table-bordered table-striped">
        <thead id="cabecera">
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
                <tr class="total-row">
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
        </tbody>
    </table>
    <br>

    <!-- Filas de Totales -->
    <h2>{{ trans('agrocefa::balance.totals') }}</h2>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr class="total-row">
                <td colspan="3" id="Total"><strong>{{ trans('agrocefa::balance.Totalexpenses') }}:</strong></td>
                <td colspan="2"><strong>{{ $totalExpenses }}</strong></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" id="Total"><strong>{{ trans('agrocefa::balance.TotalProductions') }}:</strong>
                </td>
                <td colspan="2"><strong>{{ $totalProductions }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
