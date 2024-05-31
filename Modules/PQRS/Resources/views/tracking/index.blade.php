@extends('pqrs::layouts.master')

@section('stylesheet')

<style>
    .email{
        position: relative;
        right: 290px;
    }

    .excel{
        position: relative;
        right: 580px;
    }

    .row-yellow{
        background-color: yellow !important;
    }

    .modal_answer{
        font-weight: bold;
    }
</style>

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Seguimiento PQRS</h3>            
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('pqrs.tracking.create') }}">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPQRS" title="Agregar PQRS">
                                    <i class="fas fa-plus-circle fa-fw"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col">
                            {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.email')]) !!}
                                <button type="submit" class="btn btn-info email" title="Enviar correo de alerta">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <a href="{{ route('pqrs.tracking.excel') }}">
                                <button class="btn btn-success excel" title="Cargar archivo">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="mtop16">
                        <table id="tracking" class="table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Numero Radicación</th>
                                    <th>Fecha Radicación</th>
                                    <th>Fecha Limite Respuesta</th>
                                    <th>Asunto</th>
                                    <th>Funcionario</th>
                                    <th>Estado</th>
                                    <th>Descripción asunto</th>
                                    <th>Acciones</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pqrs as $p)      
                                    <tr class="{{ $p->state == 'PROXIMO A VENCER' ? 'row-yellow' : '' }}">
                                        <td>{{ $p->filing_number }}</td>
                                        <td>{{ $p->filing_date }}</td>
                                        <td>{{ $p->end_date }}</td>
                                        <td>{{ $p->type_pqrs->name }}</td>
                                        <td>
                                            @if($p->people->isNotEmpty())
                                            {{ $p->people->first()->first_name. ' ' . $p->people->first()->first_last_name . ' ' . $p->people->first()->second_last_name}}
                                            @endif
                                        </td>
                                        <td>{{ $p->state }}</td>
                                        <td>{{ Str::limit($p->issue, 10) }}</td>
                                        <td>
                                            @if ($p->state == 'RESPUESTA GENERADA' || $p->state == 'RESPUESTA PARCIAL')
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#info{{ $p->id }}" title="Información de la {{ $p->type_pqrs->name }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>       
                                            @endif
                                            @include('pqrs::answer.answer')
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#history{{ $p->id }}" title="Historial de la {{ $p->type_pqrs->name }}">
                                                <i class="fas fa-history"></i>
                                            </button>    
                                            @include('pqrs::tracking.history')

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
   $("#tracking").DataTable({
    'responsive' : true,
   });
</script>

@endsection
