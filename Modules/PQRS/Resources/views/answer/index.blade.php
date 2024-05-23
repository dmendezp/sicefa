@extends('pqrs::layouts.master')

@section('stylesheet')
    <style>
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
                    <h3 class="card-title">Respuestas PQRS</h3>            
                </div>
                <div class="card-body">
                    @foreach ($pqrs as $p)
                    <div class="reasign-container" id="reasign-{{ $p->id }}" style="display: none;">
                        <div class="row">
                            {!! Form::open(['method' => 'post', 'url' => route('pqrs.official.answer.reasign')]) !!}
                                <div class="col-md-8">
                                    {!! Form::hidden('id', $p->id) !!}
                                    {!! Form::label('responsible', 'Funcionario') !!}
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
                            {!! Form::close() !!}
                        </div>
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
                                    <th>Radicado Respuesta</th>
                                    <th>Fecha Respuesta</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pqrs as $p)                   
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
                                            @if($p->filed_response == null)
                                                No se ha dado respuesta
                                            @else
                                                {{ $p->filed_response }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($p->response_date == null)
                                                No se ha dado respuesta
                                            @else
                                                {{ $p->response_date }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMO A VENCER')                                           
                                                <button type="button" class="btn btn-primary answer" data-bs-toggle="modal" data-bs-target="#answer{{ $p->id }}">
                                                    <i class="fas fa-retweet"></i>
                                                </button>
                                                <button type="button" class="btn btn-success reasign"  data-id="{{ $p->id }}">
                                                    <i class="fas fa-share-square"></i>
                                                </button>
                                            @endif
                                            @include('pqrs::answer.create')
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
   $("#answers").DataTable();
</script>

<script>
    $(document).ready(function() {
        $('.reasign').click(function() {
            var id = $(this).data('id');
            $('.reasign-container').hide(); // Oculta todos los divs de asignación
            $('#reasign-' + id).show(); // Muestra el div correspondiente
            $('#reasign-' + id).find('.responsible').select2({
                placeholder: 'Ingrese nombre del funcionario',
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
