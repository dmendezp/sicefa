<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF PRODUCCION</title>
</head>

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
<body>
    <br>
    <h1>{{ __('agrocefa::produccion.Reports_production') }}</h1>
    <table id="example1" style="text-align: center" class="table table-bordered table-striped">
        <thead id='cabecera'>
            <tr>
                <th>{{ __('agrocefa::produccion.Labor') }}</th>
                <th>{{ __('agrocefa::produccion.Element') }}</th>
                <th>{{ __('agrocefa::produccion.Quantity') }}</th>
                <th>{{ __('agrocefa::produccion.Expiration_date') }}</th>
                <th>{{ __('agrocefa::produccion.Total_production_price') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filterproductions as $production)
            <tr>
                <td>{{ $production->labor->activity->name }}</td>
                <td>{{ $production->element->name }}</td>
                <td>{{ $production->amount }}</td>
                <td>{{ $production->expiration_date }}</td>
                <td>{{ session('totalProductions') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
</body>

</html>
