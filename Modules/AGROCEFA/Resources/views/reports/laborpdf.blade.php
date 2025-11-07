<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('agrocefa::balancelabor.PDF Report - Labor Details') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            background: linear-gradient(to bottom, #a0dfef, #70b8e4);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h3 {
            color: #333;
            font-size: 1.8em;
            margin-bottom: 15px;
        }

        .header p {
            color: #555;
            font-size: 1.4em;
            margin-bottom: 0;
        }

        .card {
            background-color: #f2f2f2;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-header {
            padding: 10px;
            background-color: #d9edf7;
            text-align: left;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>{{ trans('agrocefa::balancelabor.Labor Details') }}</h3>
        <p>{{ trans('agrocefa::balancelabor.Executed Activity:') }} <strong>{{ $labor->activity->name }}</strong></p>
    </div>

    <div class="card">
        <div class="card-header">
            <span style="float: left;">{{ trans('agrocefa::balancelabor.Elements Associated with the Work') }}</span>
            <div style="clear: both;"></div>
        </div>

        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>{{ trans('agrocefa::balancelabor.Component') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Type') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Amount') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Unit Price') }}</th>
                        <th>{{ trans('agrocefa::balancelabor.Total Cost') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Repite el código para mostrar los elementos asociados a la labor -->
                    @foreach ($laborDetails->equipments as $equipment)
                        <tr>
                            <td>{{ $equipment->inventory->element->name }}</td>
                            <td>{{ trans('agrocefa::balancelabor.Equipment') }}</td>
                            <td>{{ $equipment->amount }}</td>
                            <td>{{ $equipment->price }}</td>
                            <td>{{ $equipment->amount * $equipment->price }}</td>
                        </tr>
                    @endforeach

                    @foreach ($laborDetails->consumables as $consumable)
                        <tr>
                            <td>{{ $consumable->inventory->element->name }}</td>
                            <td>{{ trans('agrocefa::balancelabor.Consumable') }}</td>
                            <td>{{ $consumable->amount }}</td>
                            <td>{{ $consumable->price }}</td>
                            <td>{{ $consumable->amount * $consumable->price }}</td>
                        </tr>
                    @endforeach

                    @foreach($labor->executors as $executor)
                    <tr>
                        <td>{{ $executor->person->first_name }}</td>
                        <td>{{ trans('agrocefa::balancelabor.Contracted personnel') }}</td>
                        <td>{{ $executor->amount }}</td>
                        <td>{{ $executor->price }}</td>
                        <td>{{ $executor->amount * $executor->price }}</td>
                    </tr>
                @endforeach
    
                @foreach($labor->tools as $tool)
                    <tr>
                        <td>{{ $tool->inventory->element->name }}</td>
                        <td>{{ trans('agrocefa::balancelabor.Tool') }}</td>
                        <td>{{ $tool->amount }}</td>
                        <td>{{ $tool->price }}</td>
                        <td>{{ $tool->amount * $tool->price }}</td>
                    </tr>
                @endforeach
    
                @foreach($labor->productions as $production)
                    <tr>
                        <td>{{ $production->element->name }}</td>
                        <td>{{ trans('agrocefa::balancelabor.Production') }}</td>
                        <td>{{ $production->amount }}</td>
                        <td>{{ $production->element->price }}</td>
                        <td>{{ $production->amount * $production->element->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
