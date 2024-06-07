@extends('pqrs::layouts.master')

@section('stylesheet')
    <style>
        .reasign-container{
            margin-bottom: 10px;
        }

        .modal_answer{
            font-weight: bold;
        }
        .row-yellow{
            background-color: yellow !important;
        }

        .answer{
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Mis PQRS</h3>            
                </div>
                <div class="card-body">
                    @foreach ($pqrs as $p)
                    <div class="reasign-container" id="reasign-{{ $p->id }}" style="display: none;">
                        {!! Form::open(['method' => 'post', 'url' => route('pqrs.official.answer.reasign')]) !!}
                        <p> <strong>Número Radicación: </strong> {{ $p->filing_number }} </p>
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::label('type', 'Tipo') !!}
                                    {!! Form::select('type', ['' => 'Seleccione el tipo de asignación', 'Funcionario' => 'Funcionario', 'Apoyo' => 'Apoyo'], null ,['class' => 'form-control type', 'style' => 'width: 100%;']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::hidden('id', $p->id) !!}
                                    {!! Form::label('responsible', 'Nombre de quien se le asigna') !!}
                                    {!! Form::select('responsible', [], null ,['class' => 'form-control responsible', 'style' => 'width: 100%;']) !!}
                                    @error('responsible')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    @endforeach
                    <div class="mtop16">
                        <table id="answers" class="table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Numero Radicación</th>
                                    <th>Fecha Limite Respuesta</th>
                                    <th>Asunto</th>
                                    <th>Descripción Asunto</th>
                                    <th>Estado</th>
                                    <th>Respuesta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pqrs as $p)   
                                    @foreach ($p->people as $person)                                                 
                                        @if ($person->id == Auth::user()->person_id)
                                            <tr class="{{ $p->state == 'PROXIMO A VENCER' ? 'row-yellow' : '' }}">
                                                <td>{{ $p->filing_number }}</td>
                                                <td>{{ $p->end_date }}</td>
                                                <td>{{ $p->type_pqrs->name }}</td>
                                                <td>{{ $p->issue }}</td>
                                                <td>{{ $p->state }}</td>
                                                <td>
                                                    @if($p->answer == null)
                                                        No se ha dado respuesta
                                                    @else
                                                        {{ Str::limit($p->answer, 10) }} 
                                                    @endif
                                                </td>                                    
                                                <td>
                                                    @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMO A VENCER')
                                                        @if ($person->id == Auth::user()->person_id)                                          
                                                            <button type="button" class="btn btn-primary answer" data-bs-toggle="modal" data-bs-target="#answer{{ $p->id }}" title="Responser {{ $p->type_pqrs->name }}">
                                                                <i class="fas fa-retweet"></i>
                                                            </button>
                                                        @endif  
                                                    @endif
                                                    @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMO A VENCER')
                                                        <button type="button" class="btn btn-success reasign" data-id="{{ $p->id }}" title="Reasignar {{ $p->type_pqrs->name }}">
                                                            <i class="fas fa-share-square"></i>
                                                        </button>
                                                    @endif
                                                    @include('pqrs::answer.create')
                                                    @if ($p->state == 'RESPUESTA GENERADA' || $p->state == 'RESPUESTA PARCIAL')
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#info{{ $p->id }}" title="Información de la {{ $p->type_pqrs->name }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>       
                                                    @endif
                                                    @include('pqrs::answer.answer')
                                                </td>
                                            </tr>   
                                        @endif       
                                    @endforeach                              
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
   $("#answers").DataTable();
</script>

<script>
    $(document).ready(function() {
        $('.reasign').click(function() {
            var id = $(this).data('id');
            $('.reasign-container').hide(); // Oculta todos los divs de asignación
            $('#reasign-' + id).show(); // Muestra el div correspondiente
            $('#reasign-' + id).find('.responsible').select2({
                placeholder: 'Ingrese nombre de la persona que va ha asignar',
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route("pqrs.official.answer.searchOfficial") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            name: params.term,
                        };
                    },
                    processResults: function(data) {
                        var results = data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        });

                        return {
                            results: results
                        };
                    },
                    cache: true
                }
            });
        });
    });
</script>
@endsection
