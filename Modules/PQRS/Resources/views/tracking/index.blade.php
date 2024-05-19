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
                    @foreach ($pqrs as $p)
                    <div class="assign-container" id="assign-{{ $p->id }}" style="display: none;">
                        <div class="row">
                            {!! Form::open(['method' => 'post', 'url' => route('pqrs.tracking.assign', ['id' => $p->id])]) !!}
                                <div class="col-md-12">
                                    {!! Form::label('responsible', 'Funcionario') !!}
                                    {!! Form::select('responsible', [], null ,['class' => 'form-control responsible', 'style' => 'width: 100%;']) !!}
                                    @error('responsible')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="btn btn-info" style="position: relative; left: 400px; bottom: 32px">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @endforeach
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
                                    <th>Radicado Respuesta</th>
                                    <th>Fecha Respuesta</th>
                                    <th>Acciones 
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPQRS">
                                            <i class="fas fa-plus-circle fa-fw"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pqrs as $p)      
                                    <tr  class="{{ $p->state == 'PROXIMO A VENCER' ? 'row-yellow' : '' }}">
                                        <td>{{ $p->filing_number }}</td>
                                        <td>{{ $p->nis }}</td>
                                        <td>{{ $p->filing_date }}</td>
                                        <td>{{ $p->end_date }}</td>
                                        <td>{{ $p->type_pqrs->name }}</td>
                                        <td>
                                            @if($p->people->isNotEmpty())
                                                {{ $p->people->first()->first_name. ' ' . $p->people->first()->first_last_name . ' ' . $p->people->first()->second_last_name}}
                                            @else
                                                No asignado
                                            @endif  
                                        </td>
                                        <td>{{ $p->state }}</td>
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
                                            <button type="button" class="btn btn-info assign-btn" data-id="{{ $p->id }}">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
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

@include('pqrs::tracking.create')

@endsection

@section('script')
<script>
   $("#tracking").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
</script>

<script>
    $(document).ready(function() {
        $('.assign-btn').click(function() {
            var id = $(this).data('id');
            $('.assign-container').hide(); // Oculta todos los divs de asignación
            $('#assign-' + id).show(); // Muestra el div correspondiente
            $('#assign-' + id).find('.responsible').select2({
                placeholder: 'Ingrese nombre del funcionario',
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route("pqrs.tracking.searchOfficial") }}',
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
