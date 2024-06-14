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
                    <h3 class="card-title">{{ trans('pqrs::answer.my_pqrs') }}</h3>            
                </div>
                <div class="card-body">
                    @foreach ($pqrs as $p)
                    <div class="reasign-container" id="reasign-{{ $p->id }}" style="display: none;">
                        {!! Form::open(['method' => 'post', 'url' => route('pqrs.official.answer.reasign')]) !!}
                        <p> <strong>{{ trans('pqrs::answer.filing_number') }}: </strong> {{ $p->filing_number }} </p>
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::label('type', trans('pqrs::answer.type')) !!}
                                    {!! Form::select('type', ['' => trans('pqrs::answer.select_the_type_of_assignment'), 'Funcionario' => trans('pqrs::answer.official'), 'Apoyo' => trans('pqrs::answer.assistant')], null ,['class' => 'form-control type', 'style' => 'width: 100%;']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::hidden('id', $p->id) !!}
                                    {!! Form::label('responsible', trans('pqrs::answer.name_of_who_is_assigned')) !!}
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
                                    <th>{{ trans('pqrs::answer.filing_number') }}</th>
                                    <th>{{ trans('pqrs::answer.response_deadline') }}</th>
                                    <th>{{ trans('pqrs::answer.issue') }}</th>
                                    <th>{{ trans('pqrs::answer.description_subject') }}</th>
                                    <th>{{ trans('pqrs::answer.state') }}</th>
                                    <th>{{ trans('pqrs::answer.answer') }}</th>
                                    <th>{{ trans('pqrs::answer.actions') }}</th>
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
                                                        {{ trans('pqrs::answer.no_response_has_been_given') }}
                                                    @else
                                                        {{ Str::limit($p->answer, 10) }} 
                                                    @endif
                                                </td>                                    
                                                <td>
                                                    @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMO A VENCER')
                                                        @if ($person->id == Auth::user()->person_id)                                          
                                                            <button type="button" class="btn btn-primary answer" data-bs-toggle="modal" data-bs-target="#answer{{ $p->id }}" title="{{ trans('pqrs::answer.reply') }} {{ $p->type_pqrs->name }}">
                                                                <i class="fas fa-retweet"></i>
                                                            </button>
                                                        @endif  
                                                    @endif
                                                    @if ($p->state == 'EN PROCESO' || $p->state == 'PROXIMO A VENCER')
                                                        <button type="button" class="btn btn-success reasign" data-id="{{ $p->id }}" title="{{ trans('pqrs::answer.reasign') }} {{ $p->type_pqrs->name }}">
                                                            <i class="fas fa-share-square"></i>
                                                        </button>
                                                    @endif
                                                    @include('pqrs::answer.create')
                                                    @if ($p->state == 'RESPUESTA GENERADA' || $p->state == 'RESPUESTA PARCIAL')
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#info{{ $p->id }}" title="{{ trans('pqrs::answer.information_of_the') }} {{ $p->type_pqrs->name }}">
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
    });
</script>
@endsection
