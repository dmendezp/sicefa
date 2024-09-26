@extends('layouts.emails') 
@section('stylesheet')
  
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
        .bold{
            font-weight: bold
        }
    </style>
@endsection 
@section('content')
    <div>
        <p>Cordial saludo,</p>
        <p>Se da conocimiento del reporte de alerta de las PQRS con el fin de dar respuesta en los tiempos establecidos con el objetivo de no afectar de indicador de gestión de la Regional.</p>
        <p class="bold">Se recuerda respetuosamente, el cumplimiento de la promesa de servicio de la entidad de ocho (8) días hábiles, para dar respuesta a todas las PQRS.</p>
        
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
                        <td>{{ \Carbon\Carbon::parse($p->end_date)->format('d-m-Y')}}</td>
                        <td>{{ $p->type_pqrs->name }}</td>
                        <td>{{ $p->issue }}</td>
                        <td>{{ $p->state }}</td>
                        <td>{{ $p->people->first()->first_name . ' ' . $p->people->first()->first_last_name . ' ' . $p->people->first()->second_last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Cualquier inquietud comunicarse con Diego Mauricio Cuellar Torres - dmcuellar@sena.edu.co</p>
    </div>
@endsection