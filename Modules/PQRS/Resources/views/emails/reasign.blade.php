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
        <p>Se da conocimiento de reasignación de la PQRS.</p>
        
        <table id="email" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th>Radicado Solicitud</th>
                    <th>Fecha Limite Respuesta</th>
                    <th>Asunto</th>
                    <th>Descripción Asunto</th>
                    <th>Estado</th>
                    <th>Funcionario Asignado</th>
                    <th>Apoyo</th>
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
                        <td>
                            @foreach($p->people as $support)
                                @if($support->pivot->type == 'Apoyo')
                                    {{ $support->first_name . ' ' . $support->first_last_name . ' ' . $support->second_last_name }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Cualquier inquietud comunicarse con Diego Mauricio Cuellar Torres - dmcuellar@sena.edu.co</p>
    </div>
@endsection

