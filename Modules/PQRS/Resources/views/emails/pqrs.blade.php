<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            color: black;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        
        p{
            color: black;
        }
    </style>
</head>
<body>
    <div>
        <p>Cordial saludo,</p>

        <p>Adjunto las PQRS que estan proximas a vencer</p>
        
        <table id="email" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th>Numero Radicación</th>
                    <th>Fecha Limite Respuesta</th>
                    <th>Asunto</th>
                    <th>Descripción Asunto</th>
                    <th>Estado</th>
                    <th>Funcionario Asignado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pqrs as $p)   
                    <tr>
                        <td>{{ $p->filing_number }}</td>
                        <td>{{ $p->end_date }}</td>
                        <td>{{ $p->type_pqrs->name }}</td>
                        <td>{{ $p->issue }}</td>
                        <td>{{ $p->state }}</td>
                        <td>{{ $p->people->first()->first_name . ' ' . $p->people->first()->first_last_name . ' ' . $p->people->first()->second_last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
