@extends('pqrs::layouts.master')

@section('stylesheet')
    <style>
        .row-yellow{
            background-color: yellow !important;
        }

        .answer{
            margin-bottom: 10px;
        }

        .info{
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
                    <h3 class="card-title">{{ trans('pqrs::answer.my_pqrs') }}</h3>            
                </div>
                <div class="card-body">
                    <table id="answers" class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>{{ trans('pqrs::answer.filing_number') }}</th>
                                <th>{{ trans('pqrs::answer.response_deadline') }}</th>
                                <th>{{ trans('pqrs::answer.issue') }}</th>
                                <th>{{ trans('pqrs::answer.description_subject') }}</th>
                                <th>{{ trans('pqrs::answer.state') }}</th>
                                <th>{{ trans('pqrs::answer.answer') }}</th>
                                <th>{{ trans('pqrs::tracking.response_filing_number') }}</th>
                                <th>{{ trans('pqrs::answer.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pqrs as $p)   
                                @foreach ($p->people as $person)                                                 
                                    @if ($person->id == Auth::user()->person_id)
                                        <tr class="{{ $p->state == 'PROXIMA A VENCER' ? 'row-yellow' : '' }}">
                                            <td>{{ $p->filing_number }}</td>
                                            <td>{{ $p->end_date }}</td>
                                            <td>{{ $p->type_pqrs->name }}</td>
                                            <td>{{ $p->issue }}</td>
                                            <td>{{ $p->state }}</td>
                                            <td>
                                                @if($p->answer == null)
                                                    {{ trans('pqrs::answer.no_response_has_been_given') }}
                                                @else
                                                    {{ Str::limit($p->answer, 10) }} 
                                                @endif
                                            </td>   
                                            <td>
                                                @if(isset($p->filed_response))
                                                    {{ $p->filed_response }}
                                                @else
                                                    No se ha dado respuesta.
                                                @endif
                                            </td>                                 
                                            <td>
                                                @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMA A VENCER' || $p->state == 'RESPUESTA PARCIAL')
                                                    @if ($person->id == Auth::user()->person_id)                                          
                                                        <button type="button" class="btn btn-primary answer" data-bs-toggle="modal" data-bs-target="#answer{{ $p->id }}" title="{{ trans('pqrs::answer.reply') }} {{ $p->type_pqrs->name }}">
                                                            <i class="fas fa-retweet"></i>
                                                        </button>
                                                    @endif  
                                                @endif
                                                @if ($person->pivot->type == 'Funcionario' && $p->state == 'EN PROCESO' || $p->state == 'PROXIMA A VENCER')
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reasign{{ $p->id }}" title="{{ trans('pqrs::answer.reasign') }} {{ $p->type_pqrs->name }}">
                                                        <i class="fas fa-share-square"></i>
                                                    </button>
                                                @endif
                                                @include('pqrs::answer.create')
                                                @include('pqrs::answer.reasign')
                                                @if ($p->state == 'RESPUESTA GENERADA' || $p->state == 'RESPUESTA PARCIAL')
                                                    <button type="button" class="btn btn-warning info" data-bs-toggle="modal" data-bs-target="#info{{ $p->id }}" title="{{ trans('pqrs::answer.information_of_the') }} {{ $p->type_pqrs->name }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>       
                                                @endif
                                                @include('pqrs::answer.answer')
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#history{{ $p->id }}" title="{{ trans('pqrs::tracking.history_of_the') }} {{ $p->type_pqrs->name }}">
                                                    <i class="fas fa-history"></i>
                                                </button>    
                                                @include('pqrs::tracking.history')
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
@endsection

@section('script')
<script>
    $("#answers").DataTable({
        'responsive' : true,
        'ordering' : false,
    });

    $(document).ready(function() {   
        $('.modal').on('shown.bs.modal', function () {
            var modal = $(this);
            
            modal.find('#responsible').select2({
                dropdownParent: modal,
                placeholder: '{{ trans("pqrs::answer.enter_the_name_of_the_person_you_are_going_to_assign") }}',
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

        // Prevenir que el modal se cierre al interactuar con Select2
        $('.modal').on('click', '.select2-selection', function (e) {
            e.stopPropagation();
        });
    });
</script>

@endsection
