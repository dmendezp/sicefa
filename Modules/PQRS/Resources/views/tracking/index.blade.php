@extends('pqrs::layouts.master')

@section('stylesheet')

<style>
    .row-yellow{
        background-color: yellow !important;
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
                    <a href="{{ route('pqrs.tracking.create') }}">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPQRS">
                            <i class="fas fa-plus-circle fa-fw"></i>
                        </button>
                    </a>
                    <br>
                    <div class="mtop16">
                        <table id="tracking" class="table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Numero Radicación</th>
                                    <th>NIS</th>
                                    <th>Fecha Radicación</th>
                                    <th>Fecha Limite Respuesta</th>
                                    <th>Asunto</th>
                                    <th>Funcionario</th>
                                    <th>Estado</th>
                                    <th>Respuesta</th>
                                    <th>Acciones</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pqrs as $p)      
                                    <tr class="{{ $p->state == 'PROXIMO A VENCER' ? 'row-yellow' : '' }}">
                                        <td>{{ $p->filing_number }}</td>
                                        <td>{{ $p->nis }}</td>
                                        <td>{{ $p->filing_date }}</td>
                                        <td>{{ $p->end_date }}</td>
                                        <td>{{ $p->type_pqrs->name }}</td>
                                        <td>{{ $p->people->first()->first_name. ' ' . $p->people->first()->first_last_name . ' ' . $p->people->first()->second_last_name}}</td>
                                        <td>{{ $p->state }}</td>
                                        <td>
                                            @if($p->answer == null)
                                                No se ha dado respuesta
                                            @else
                                                {{ Str::limit($p->answer, 10) }}                                                                                        
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->state == 'RESPUESTA GENERADA' || $p->state == 'RESPUESTA PARCIAL')
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#info{{ $p->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>       
                                            @endif
                                            @include('pqrs::answer.answer')
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
